<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Questionnarie;
use CodeIgniter\Exceptions\PageNotFoundException;

use App\Models\QuestionModel;
use App\Models\QuestionnariesModel;
use App\Models\ResponseOptionModel;
use CodeIgniter\Controller;

class QuestionnarieController extends BaseController
{

    private $session;
    private const PAGINATION = 1000;
    private const STATUS = 4;
    
    protected $questionnaireModel;
    protected $questionModel;
    protected $responseOptionModel;
    protected $db;

    public function __construct()
    {
        // 1. Inicializar Modelos y Conexión a la BD
        $this->questionnaireModel = new QuestionnariesModel();
        $this->questionModel = new QuestionModel();
        $this->responseOptionModel = new ResponseOptionModel();
        $this->db = \Config\Database::connect();
    }

    public function index(){
        $areaModel = model('AreaModel');
        $questionnariesModel = model('QuestionnariesModel');
        $data['session'] = session()->get();
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $data['questionnaries'] = $questionnariesModel
                            ->join('status s','s.status_id = questionnaries.status_id','LEFT')
                            ->select('questionnaries.*, s.status_name')
                            ->paginate(self::PAGINATION);
        return view('admin/questionnarie/index',$data);
    }

    public function add(){
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $statusModel = model('StatusModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        
        return view('admin/questionnarie/add',$data);
    }

    /**
     * Procesa la solicitud POST para crear el cuestionario completo.
     */
    public function create(){
        // 2. Obtener y parsear el JSON de la solicitud
        $data = $this->request->getJSON(true);

        if (empty($data) || !isset($data['questions'])) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Datos de cuestionario inválidos.']);
        }

        // --- INICIO DE LA TRANSACCIÓN ---
        $this->db->transBegin();

        try {
            $questionnaireData = [
                'questionnarie_title'       => $data['title'] ?? 'Cuestionario Temporal',
                'questionnarie_description' => $data['description'] ?? '',
                'status_id'                 => 1,
            ];
            $this->questionnaireModel->insert($questionnaireData);
            $questionnaireId = $this->questionnaireModel->insertID(); // ID de la cabecera

            // 4. Insertar Preguntas y Opciones
            foreach ($data['questions'] as $questionData) {
                // Preparar datos de la pregunta
                $questionInsert = [
                    'questionnarie_id' => $questionnaireId,
                    'question_text'    => $questionData['text'],
                    'response_type'    => $questionData['type'],
                    'display_order'    => $questionData['order'] ?? 0,
                ];
                
                $this->questionModel->insert($questionInsert);
                $questionId = $this->questionModel->insertID(); // ID de la pregunta

                // 5. Insertar Opciones (solo si el tipo lo requiere)
                if (in_array($questionData['type'], ['SINGLE_SELECT', 'MULTIPLE_CHOICE'])) {
                    
                    if (isset($questionData['options']) && is_array($questionData['options'])) {
                        foreach ($questionData['options'] as $optionData) {
                            $optionInsert = [
                                'question_id' => $questionId,
                                'option_text' => $optionData['text'],
                                'option_value' => $optionData['value'] ?? null, // Usar 'text' si no hay 'value'
                            ];
                            $this->responseOptionModel->insert($optionInsert);
                        }
                    }
                }
            }
            
            // 6. Finalizar la Transacción
            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return $this->response->setStatusCode(500)->setJSON(['error' => 'La creación falló durante una inserción. Rollback ejecutado.']);
            } else {
                $this->db->transCommit();
                return $this->response->setJSON(['status' => 'success', 'message' => 'Cuestionario creado con éxito.', 'id' => $questionnaireId]);
            }

        } catch (\Exception $e) {
            $this->db->transRollback();
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Error del servidor: ' . $e->getMessage()]);
        }
    }

    public function edit(int $questionnaireId)
    {
        // Usamos el Query Builder para obtener la estructura anidada.
        // **ESTO ES UNA DEMOSTRACIÓN SIMPLIFICADA.**
        // En producción, es mejor obtener primero el cuestionario, luego las preguntas,
        // y luego las opciones, y ensamblar el array en PHP antes de pasarlo a la vista.
        
        $rawDetails = $this->db->table('questionnaries q')
                                ->select('q.questionnarie_id, q.questionnarie_title, q.questionnarie_description, q.status_id, 
                                            p.question_id, p.question_text, p.response_type, p.display_order,
                                            o.response_option_id, o.option_text, o.option_value')
                                ->join('questions p', 'p.questionnarie_id = q.questionnarie_id', 'left')
                                ->join('response_options o', 'o.question_id = p.question_id', 'left')
                                ->where('q.questionnarie_id', $questionnaireId)
                                ->orderBy('p.display_order', 'ASC')
                                ->get()
                                ->getResultArray();
                            
        // Ensamblar los datos en una estructura JSON compatible con el JS (CLAVE)
        $data['questionnaire'] = $this->assembleDataForFrontend($rawDetails);
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $data['session'] = session()->get();

        return view('admin/questionnarie/edit', $data);
    }
    
    /**
     * Convierte el resultado plano de la BD en un array anidado.
     */
    private function assembleDataForFrontend(array $rawDetails): array
    {
        if (empty($rawDetails)) {
            return ['questionnaire' => null];
        }
        
        $questionnaire = [
            'id' => $rawDetails[0]['questionnarie_id'],
            'title' => $rawDetails[0]['questionnarie_title'],
            'description' => $rawDetails[0]['questionnarie_description'],
            'status_id' => $rawDetails[0]['status_id'],
            'questions' => []
        ];
        
        $questions = [];
        
        foreach ($rawDetails as $row) {
            $qId = $row['question_id'];
            
            if (!isset($questions[$qId])) {
                $questions[$qId] = [
                    'id' => $qId,
                    'text' => $row['question_text'],
                    'type' => $row['response_type'],
                    'order' => $row['display_order'],
                    'options' => []
                ];
            }
            
            if ($row['response_option_id']) {
                $questions[$qId]['options'][] = [
                    'id' => $row['response_option_id'],
                    'text' => $row['option_text'],
                    'value' => $row['option_value']
                ];
            }
        }
        
        $questionnaire['questions'] = array_values($questions);
        
        return ['questionnaire' => $questionnaire];
    }



    // private $session;
    // private const PAGINATION = 1000;
    // private const STATUS = 4;

    // public function __construct(){
    //     $session = session()->get();
    // }

    // public function index(){
    //     $areaModel = model('AreaModel');
    //     $questionnariesModel = model('QuestionnariesModel');
    //     $data['session'] = session()->get();
    //     $data['areas'] = $areaModel->where('status_id', 1)->findAll();
    //     $data['questionnaries'] = $areaModel
    //                         ->join('status s','s.status_id = questionnaries.status_id','LEFT')
    //                         ->select('questionnaries.*, s.status_name')
    //                         ->paginate(self::PAGINATION);
    //     return view('admin/questionnarie/index',$data);
    // }
    
    // public function add(){
    //     $data['session'] = session()->get();
    //     $areaModel = model('AreaModel');
    //     $data['areas'] = $areaModel->where('status_id', 1)->findAll();
    //     $statusModel = model('StatusModel');
    //     $data['status'] = $statusModel->where('status_category',1)->findAll();
        
    //     return view('admin/questionnarie/add',$data);
    // }

    // public function edit(int $questionnarie_id){
    //     $questionnariesModel = model('QuestionnariesModel');
    //     if(!$data['questionnarie'] = $questionnariesModel->where('questionnarie_id', $questionnarie_id)->first()){
    //         throw PageNotFoundException::forPageNotFound();
    //     }
    //     $data['session'] = session()->get();
    //     $areaModel = model('AreaModel');
    //     $data['areas'] = $areaModel->where('status_id', 1)->findAll();
    //     $statusModel = model('StatusModel');
    //     $data['status'] = $statusModel->where('status_category',1)->findAll();
    //     return view('admin/questionnarie/edit',$data);
    // }

    // public function store(){
    //     $validation = service('validation');
    //     $validation->setRules([
    //         'questionnarie_title'          => ['label' => 'nombre(s)','rules' => 'required'],
    //         'questionnarie_description'   => ['label' => 'apellido(s)' ,'rules' => 'required|alpha_space'],
    //     ]);

    //     if(!$validation->withRequest($this->request)->run()){
    //         return redirect()->back()->withInput()->with('errors',$validation->getErrors());
    //     }

    //     $formQuestionnarie = $this->request->getPost();
    //     $register = [
    //         'status_id'     => 1,//1 active
    //     ];
        
    //     $questionnarieData = array_merge($formQuestionnarie,$register);
    //     $questionnarie = new Questionnarie($questionnarieData);
    //     $questionnariesModel = model('QuestionnariesModel');

    //     $questionnariesModel->save($questionnarie);
    //     return redirect()->route('admin/questionnaries')->with('msg',[
    //         'type' => 'green',
    //         'body' => 'Nuevo cuestionario registrad exitosamente!'
    //     ]);
    // }

    // public function update(){
    //     $validation = service('validation');
    //     $validation->setRules([
    //         'area_name'          => ['label' => 'nombre(s)','rules' => 'required'],
    //         'area_description'   => ['label' => 'apellido(s)' ,'rules' => 'required|alpha_space'],
    //     ]);
        
    //     if(!$validation->withRequest($this->request)->run()){
    //         return redirect()->back()->withInput()->with('errors',$validation->getErrors());
    //     }
        
    //     $model = model('AreaModel');
    //     if(!$model->where('area_id', (int)trim($this->request->getVar('area_id')))->first()){
    //         throw PageNotFoundException::forPageNotFound();
    //     }
    //     $areaSlug = $this->createSlug(trim($this->request->getVar('area_name')));
    //     $model->save([
    //         'area_id'            => trim($this->request->getVar('area_id')),
    //         'area_name'          => trim($this->request->getVar('area_name')),
    //         'area_description'   => trim($this->request->getVar('area_description')),
    //         'area_slug'          => $areaSlug,
    //         'status_id'          => (int)trim($this->request->getVar('status_id')),
    //     ]);
    //     return redirect()->route('admin/areas')->with('msg',[
    //         'type'=>'green',
    //         'body'=> 'El area se actualizo exitosamente.'
    //     ]);   
    // }

    // private function createSlug($str){
    //     $delimiter = '_';
    //     $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
    //     return $slug;
    // }

    // public function view_area($areaSlug, $areaId){
    //     $data['session'] = session()->get();
    //     $areaModel = model('AreaModel');
    //     $data['areas'] = $areaModel->where('status_id', 1)->findAll();
    //     $beneficiaryModel = model('BeneficiaryModel');
    //     $supportModel = model('SuportModel');
    //     $statusModel = model('StatusModel');
    //     $data['area_id'] = $areaId;
    //     $data['beneficiaries'] = $beneficiaryModel
    //                         ->join('kardices k', 'k.beneficiary_id = beneficiaries.beneficiary_id','LEFT')
    //                         ->join('status s','s.status_id = beneficiaries.status_id','LEFT')
    //                         ->join('cities c','c.city_id = beneficiaries.city_id','LEFT')
    //                         ->like('k.beneficiary_area',"%{$areaId}%")
    //                         ->select('beneficiaries.*, s.status_name, c.city_name, k.kardex_id')
    //                         ->orderBy('beneficiary_lastname')
    //                         ->paginate(self::PAGINATION);
    //     $data['supports'] = $supportModel->where('area_id',$areaId)->where('status_id',1)->findAll();
    //     $data['status'] = $statusModel->where('status_category',2)->findAll();
    //     return view('admin/beneficiary/beneficiaries_area',$data);
    // }
}
