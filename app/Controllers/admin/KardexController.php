<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Kardex;
use CodeIgniter\Exceptions\PageNotFoundException;

class KardexController extends BaseController
{
   

    public function viewKardex($beneficiary_id){
        
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $beneficiaryModel = model('BeneficiaryModel');
        $submissionModel = model('SubmissionModel'); // Usamos el nuevo modelo
        $questionnaireModel = model('QuestionnariesModel');

        // 1. Obtener los datos del beneficiario (esto se mantiene igual)
        $data['beneficiary'] = $beneficiaryModel->join('schedules s','s.schedule_id = beneficiaries.schedule_id','LEFT')
                                                ->join('cities c','c.city_id = beneficiaries.city_id','LEFT')
                                                ->join('social_medias sm','sm.sm_id = beneficiaries.sm_id','LEFT')
                                                ->select('beneficiaries.*, s.schedule_description, c.city_name, sm_name')
                                                ->where('beneficiary_id', $beneficiary_id)
                                                ->first();
                                                
        if (empty($data['beneficiary'])) {
             // Lanza excepción si el beneficiario no existe
            throw PageNotFoundException::forPageNotFound();
        }

        // 2. Obtener el historial de cuestionarios llenados (Submissions)
        // Obtenemos todos los intentos de llenado (submissions) de este usuario.
        $data['submissions'] = $submissionModel
                                                ->where('submissions.user_id', $beneficiary_id) // Asumimos que beneficiary_id es el mismo que user_id en submissions
                                                ->join('questionnaries q', 'q.questionnarie_id = submissions.questionnaire_id', 'LEFT')
                                                ->select('submissions.submission_id AS submission_id, submissions.submitted_at, submissions.status, 
                                                            q.questionnarie_title, q.questionnarie_id')
                                                ->orderBy('submissions.submitted_at', 'DESC') // Los más recientes primero
                                                ->findAll();
                                                
        // Las siguientes líneas deben ir al final para preparar la vista
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        
        // El nombre de la vista debe cambiar para reflejar el contenido (ej. questionnaire_history)
        return view('admin/kardex/index', $data);
    }

    public function kardexBeneficiary(){
        $beneficiary_id = $this->request->getPost('beneficiary');
        $areaModel = model('AreaModel');
        $kardexModel = model('KardexModel');

        $areasBeneficiaryStr = $kardexModel->where('kardices.beneficiary_id', $beneficiary_id)->select('kardices.beneficiary_area,kardices.kardex_id')->first();
        $beneficiaryAreas = $this->strToArray($areasBeneficiaryStr['beneficiary_area']);
        $areas = [];
        foreach ($beneficiaryAreas as $ba) {
            array_push($areas, $areaModel->where('area_id',(int)$ba)->select('area_id,area_name')->first());
        }
        $data['kardex'] = $areasBeneficiaryStr;
        $data['areas'] = $areas;
        echo json_encode($data);
    }
    
    public function viewKardexArea($kardexId, $areaId){
        $areaModel = model('AreaModel');
        $kardexModel = model('KardexModel');
        $kardexDetailModel = model('KardexDetailModel');
        $supportModel = model('SuportModel');
        $activitiesModel = model('ActivityModel');
        $statusModel = model('StatusModel');
        $data['session'] = session()->get();
        $data['areaBeneficiary_id'] = $areaId;
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $data['supports'] = $supportModel->where('status_id', 1)->findAll();

        $data['beneficiary'] = $kardexModel->join('beneficiaries b', 'b.beneficiary_id = kardices.beneficiary_id','LEFT')
                                            ->where('kardices.kardex_id', $kardexId)
                                            ->select('b.beneficiary_id,b.beneficiary_name, b.beneficiary_lastname,kardices.kardex_id')
                                            ->first();

        $data['activities'] = $kardexDetailModel->join('supports s','kardexdetails.support_id = s.support_id','LEFT')
                                            ->join('status st','kardexdetails.status_id = st.status_id','LEFT')
                                            ->join('areas a','kardexdetails.area_id = a.area_id','LEFT')
                                            ->where('kardexdetails.kardex_id', $kardexId)
                                            ->where('kardexdetails.area_id', $areaId)
                                            ->select('kardexdetails.*,a.area_name ,s.support_name, st.status_name')
                                            ->findAll();
        $data['form_activities'] = $activitiesModel->where('status_id', 1)->findAll();
        $data['status'] = $statusModel->where('status_category', 2)->findAll();
        return view('admin/kardex/activities_area',$data);
    }
    
    public function store(){
        $beneficiary_id = $this->request->getPost('beneficiary');
        $kardexModel = model('KardexModel');
        $area_id = $this->request->getPost('area');
        $last_area = $this->request->getPost('last_area');
        if(!$kardex = $kardexModel->where('beneficiary_id', $beneficiary_id)->select('kardices.kardex_id,kardices.beneficiary_area')->first()){
            $formData = [
                'beneficiary_id'        => $beneficiary_id,
                'beneficiary_area'      => "$area_id",
            ];
            $kardex = new Kardex($formData);
            $kardexModel->save($kardex);
        }else{
            if(!$last_area == ""){
                $beneficiaryNewArea = $this->replaceStringElement($kardex['beneficiary_area'],$last_area,$area_id); //"{$kardex['beneficiary_area']},$area_id",
                $formData = [
                    'kardex_id'             => $kardex['kardex_id'],
                    'beneficiary_id'        => $beneficiary_id,
                    'beneficiary_area'      => $beneficiaryNewArea
                ];
                $kardexModel->save($formData);
            }elseif(!strstr($kardex['beneficiary_area'],"$area_id")){
                    $formData = [
                        'kardex_id'             => $kardex['kardex_id'],
                        'beneficiary_id'        => $beneficiary_id,
                        'beneficiary_area'      => "{$kardex['beneficiary_area']},$area_id",
                    ];
                    $kardexModel->save($formData);
            }
        }
        echo json_encode("ok");
    }

    function replaceStringElement($originalString, $searchElement, $replaceElement) {
        // Reemplaza el elemento de búsqueda por el elemento de reemplazo en la cadena original
        $newString = str_replace($searchElement, $replaceElement, $originalString);
        
        return $newString;
    }

    public function editAreaBeneficiary(){
        $beneficiary_id = $this->request->getPost('beneficiary');
        $area_id = $this->request->getPost('area');
        $areaModel = model('AreaModel');
        $kardexModel = model('KardexModel');

        $areasBeneficiaryStr = $kardexModel->where('kardices.beneficiary_id', $beneficiary_id)->select('kardices.beneficiary_area,kardices.kardex_id')->first();
        $beneficiaryAreas = $this->strToArray($areasBeneficiaryStr['beneficiary_area']);
        $areas = [];
        foreach ($beneficiaryAreas as $ba) {
            array_push($areas, $areaModel->where('area_id',(int)$ba)->select('area_id,area_name')->first());
        }
        echo json_encode($areas);
    }

    public function deleteAreaBeneficiary(){
        $area_id = $this->request->getPost('area');
        $beneficiary_id = $this->request->getPost('beneficiary');
        $kardex_id = $this->request->getPost('kBeneficiary');
        $kardexModel = model("KardexModel");
        $kardex = $kardexModel->where('kardex_id', $kardex_id)->select('kardices.kardex_id,kardices.beneficiary_area')->first();
        $beneficiaryNewArea = $this->replaceStringElement($kardex['beneficiary_area'],"$area_id",""); 
        $beneficiaryNewArea = $this->orderNumbersInString($beneficiaryNewArea);
        $formData = [
            'kardex_id'             => $kardex_id,
            'beneficiary_area'      => $beneficiaryNewArea
        ];
        $kardexModel->save($formData);
        echo "ok";
    }

    function orderNumbersInString($inputString) {
        // Separa los números en un array eliminando valores vacíos
        $numbers = array_filter(explode(',', $inputString), 'is_numeric');
        
        // Ordena los números en el array
        sort($numbers);
        
        // Convierte el array ordenado en una cadena
        $sortedString = implode(',', $numbers);
        
        return $sortedString;
    }

    private function strToArray($str){
        $array = explode(',', $str);
        return $array;
    }
}
