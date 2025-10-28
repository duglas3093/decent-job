<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\QuestionModel;
use App\Models\QuestionnairesModel;
use App\Models\ResponseOptionModel;
use App\Models\SubmissionModel;
use App\Models\UserResponseModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class QuestionnaireController extends BaseController
{

    private $session;
    private const PAGINATION = 1000;
    private const STATUS = 4;
    
    protected $questionnaireModel;
    protected $questionModel;
    protected $responseOptionModel;
    protected $submissionModel;
    protected $userResponseModel;
    protected $db;

    public function __construct()
    {
        
        $this->questionnaireModel = new QuestionnairesModel();
        $this->questionModel = new QuestionModel();
        $this->responseOptionModel = new ResponseOptionModel();
        $this->submissionModel = new SubmissionModel();
        $this->userResponseModel = new UserResponseModel();
        $this->db = \Config\Database::connect();
    }

    public function index(){
        $areaModel = model('AreaModel');
        $QuestionnairesModel = model('QuestionnairesModel');
        $data['session'] = session()->get();
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $data['questionnaires'] = $QuestionnairesModel
                            ->join('status s','s.status_id = questionnaires.status_id','LEFT')
                            ->select('questionnaires.*, s.status_name')
                            ->paginate(self::PAGINATION);
        return view('admin/questionnaire/index',$data);
    }

    public function add(){
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $statusModel = model('StatusModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        
        return view('admin/questionnaire/add',$data);
    }

    public function create(){
        $data = $this->request->getJSON(true);

        if (empty($data) || !isset($data['questions'])) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Datos de cuestionario inválidos.']);
        }

        $this->db->transBegin();

        try {
            $questionnaireData = [
                'questionnaire_title'       => $data['title'] ?? 'Cuestionario Temporal',
                'questionnaire_description' => $data['description'] ?? '',
                'status_id'                 => 1,
            ];
            $this->questionnaireModel->insert($questionnaireData);
            $questionnaireId = $this->questionnaireModel->insertID();

            foreach ($data['questions'] as $questionData) {
                $questionInsert = [
                    'questionnaire_id' => $questionnaireId,
                    'question_text'    => $questionData['text'],
                    'response_type'    => $questionData['type'],
                    'display_order'    => $questionData['order'] ?? 0,
                ];
                
                $this->questionModel->insert($questionInsert);
                $questionId = $this->questionModel->insertID(); 

                if (in_array($questionData['type'], ['SINGLE_SELECT', 'MULTIPLE_CHOICE'])) {
                    
                    if (isset($questionData['options']) && is_array($questionData['options'])) {
                        foreach ($questionData['options'] as $optionData) {
                            $optionInsert = [
                                'question_id' => $questionId,
                                'option_text' => $optionData['text'],
                                'option_value' => $optionData['value'] ?? null, 
                            ];
                            $this->responseOptionModel->insert($optionInsert);
                        }
                    }
                }
            }
            
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

    public function edit(int $questionnaireId){ 
        $rawDetails = $this->db->table('questionnaires q')
                                ->select('q.questionnaire_id, q.questionnaire_title, q.questionnaire_description, q.status_id, 
                                            p.question_id, p.question_text, p.response_type, p.display_order,
                                            o.response_option_id, o.option_text, o.option_value')
                                ->join('questions p', 'p.questionnaire_id = q.questionnaire_id', 'left')
                                ->join('response_options o', 'o.question_id = p.question_id', 'left')
                                ->where('q.questionnaire_id', $questionnaireId)
                                ->orderBy('p.display_order', 'ASC')
                                ->get()
                                ->getResultArray();
                            
        // Ensamblar los datos en una estructura JSON compatible con el JS (CLAVE)
        $data['questionnaire'] = $this->assembleDataForFrontend($rawDetails);
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $data['session'] = session()->get();

        return view('admin/questionnaire/edit', $data);
    }

    private function assembleDataForFrontend(array $rawDetails): array
    {
        if (empty($rawDetails)) {
            return ['questionnaire' => null];
        }
        
        $questionnaire = [
            'id' => $rawDetails[0]['questionnaire_id'],
            'title' => $rawDetails[0]['questionnaire_title'],
            'description' => $rawDetails[0]['questionnaire_description'],
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

    public function update()
    {
        $data = $this->request->getJSON(true);

        $questionnaireId = $data['id'] ?? null;

        if (empty($questionnaireId) || empty($data) || !isset($data['questions'])) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'ID de cuestionario o datos inválidos.']);
        }
        $this->db->transBegin();

        try {
            $questionnaireData = [
                'questionnaire_title'       => $data['title'] ?? 'Cuestionario Temporal',
                'questionnaire_description' => $data['description'] ?? '',
            ];
            $this->questionnaireModel->update($questionnaireId, $questionnaireData);
            
            $existingQuestionIds = $this->questionModel->where('questionnaire_id', $questionnaireId)
                                                        ->findColumn('question_id') ?? [];
            $incomingQuestionIds = array_filter(array_column($data['questions'], 'id'));
            $questionsToDelete = array_diff($existingQuestionIds, $incomingQuestionIds);

            if (!empty($questionsToDelete)) {
                $this->questionModel->whereIn('question_id', $questionsToDelete)->delete();
            }

            foreach ($data['questions'] as $questionData) {
                $qId = $questionData['id'] ?? null;
                $questionInsertUpdate = [
                    'questionnaire_id' => $questionnaireId,
                    'question_text'    => $questionData['text'],
                    'response_type'    => $questionData['type'],
                    'display_order'    => $questionData['order'] ?? 0,
                ];

                if ($qId) {
                    $this->questionModel->update($qId, $questionInsertUpdate);
                    $questionId = $qId;
                } else {
                    $this->questionModel->insert($questionInsertUpdate);
                    $questionId = $this->questionModel->insertID();
                }

                $incomingOptionIds = array_filter(array_column($questionData['options'] ?? [], 'id'));
                
                if (in_array($questionData['type'], ['SINGLE_SELECT', 'MULTIPLE_CHOICE'])) {
                    if ($qId) {
                        $existingOptionIds = $this->responseOptionModel->where('question_id', $qId)
                                                                        ->findColumn('response_option_id') ?? [];
                        $optionsToDelete = array_diff($existingOptionIds, $incomingOptionIds);
                        
                        if (!empty($optionsToDelete)) {
                            $this->responseOptionModel->whereIn('response_option_id', $optionsToDelete)->delete();
                        }
                    }

                    foreach ($questionData['options'] as $optionData) {
                        $optionId = $optionData['id'] ?? null;
                        
                        $optionInsertUpdate = [
                            'question_id'  => $questionId,
                            'option_text'  => $optionData['text'],
                            'option_value' => $optionData['value'] ?? null, 
                        ];
                        
                        if ($optionId) {
                            $this->responseOptionModel->update($optionId, $optionInsertUpdate);
                        } else {
                            $this->responseOptionModel->insert($optionInsertUpdate);
                        }
                    }
                }

            }
            
            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return $this->response->setStatusCode(500)->setJSON(['error' => 'La actualización falló durante una inserción/eliminación. Rollback ejecutado.']);
            } else {
                $this->db->transCommit();
                return $this->response->setJSON(['status' => 'success', 'message' => 'Cuestionario actualizado con éxito.', 'id' => $questionnaireId]);
            }

        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', 'Update Error: ' . $e->getMessage()); 
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Error del servidor: ' . $e->getMessage()]);
        }
    }

    public function fill(int $beneficiaryId, int $questionnaireId){
        $questionnaireModel = $this->questionnaireModel;    
        $questionnaire = $questionnaireModel->find($questionnaireId);

        if (!$questionnaire) {
            throw PageNotFoundException::forPageNotFound();
        }
        
        $rawDetails = $this->db->table('questionnaires q')
                                ->select('q.questionnaire_id, q.questionnaire_title, q.questionnaire_description,q.status_id,
                                        p.question_id, p.question_text, p.response_type, p.display_order,
                                        o.response_option_id, o.option_text, o.option_value')
                                ->join('questions p', 'p.questionnaire_id = q.questionnaire_id', 'left')
                                ->join('response_options o', 'o.question_id = p.question_id', 'left')
                                ->where('q.questionnaire_id', $questionnaireId)
                                ->orderBy('p.display_order', 'ASC')
                                ->get()
                                ->getResultArray();
        
        $data['questionnaire'] = $this->assembleDataForFrontend($rawDetails)['questionnaire'];
        
        $data['beneficiary_id'] = $beneficiaryId;
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        
        return view('admin/questionnaire/fill_submission', $data);
    }

    public function store_submission()
    {
        
        $data = $this->request->getJSON(true);

        $beneficiaryId = $data['beneficiary_id'] ?? null;
        $questionnaireId = $data['questionnaire_id'] ?? null;
        $responses = $data['responses'] ?? [];

        
        if (empty($beneficiaryId) || empty($questionnaireId) || empty($responses)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Datos insuficientes. Se requieren beneficiary_id, questionnaire_id y respuestas.']);
        }

        
        $userId = $beneficiaryId; 
        
        
        $this->db->transBegin();

        try {
            
            $submissionData = [
                'user_id' => $userId,
                'questionnaire_id' => $questionnaireId,
                'status' => 'Completed', 
            ];
            
            $submissionModel = model('SubmissionModel');
            $submissionModel->insert($submissionData);
            $submissionId = $submissionModel->insertID(); 

            $userResponseModel = model('UserResponseModel');
            $batchInsertData = [];

            
            foreach ($responses as $response) {
                $questionId = $response['question_id'];
                
                
                if (isset($response['option_ids']) && is_array($response['option_ids'])) {
                    
                    foreach ($response['option_ids'] as $optionId) {
                        if (!empty($optionId)) { 
                            $batchInsertData[] = [
                                'submission_id' => $submissionId,
                                'question_id'   => $questionId,
                                'option_id'     => (int)$optionId, 
                                'response_value'=> null,          
                            ];
                        }
                    }
                } 
                
                elseif (isset($response['value'])) {
                    $finalValue = is_array($response['value']) ? json_encode($response['value']) : (string)$response['value'];
                    $batchInsertData[] = [
                        'submission_id' => $submissionId,
                        'question_id'   => $questionId,
                        'option_id'     => null,          
                        'response_value'=> $finalValue,   
                    ];
                }
            } 
            
            
            if (!empty($batchInsertData)) {
                $userResponseModel->insertBatch($batchInsertData);
            }

            
            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                log_message('error', 'Submission store transaction failed for Submission ID: ' . ($submissionId ?? 'N/A'));
                return $this->response->setStatusCode(500)->setJSON(['error' => 'La Submission falló. Rollback ejecutado.']);
            } else {
                $this->db->transCommit();
                return $this->response->setJSON([
                    'status' => 'success', 
                    'message' => 'Respuestas guardadas con éxito.', 
                    'id' => $submissionId
                ]);
            }

        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', 'Submission Store Exception: ' . $e->getMessage() . ' | Data: ' . print_r($data, true)); 
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Error del servidor: ' . $e->getMessage()]);
        }
    }
}
