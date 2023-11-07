<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Beneficiary;
use App\Entities\Contact;
use App\Entities\Kardex;
use App\Entities\Postulant;

class PostulantController extends BaseController
{
    public function add(){
        $data['session'] = session()->get();
        $statusModel = model('StatusModel');
        $areaModel = model('AreaModel');
        $cityModel = model('CityModel');
        $scheduleModel = model('ScheduleModel');
        $socialMediaModel = model('SocialMediaModel');
        $compromiseModel = model('CompromiseModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        $data['social_medias'] = $socialMediaModel->where('status_id',1)->findAll();
        $data['schedules'] = $scheduleModel->where('status_id',1)->findAll();
        $data['cities'] = $cityModel->findAll();
        $data['compromises'] = $compromiseModel->findAll();
        $data['areas'] = $areaModel->where('status_id',1)->findAll();
        return view('users/form_postulant',$data);
    }

    public function store(){
        $validation = service('validation');

        $validation->setRules([
            'beneficiary_name'          => ['label' => 'nombre(s)','rules' => 'required'],
            'beneficiary_lastname'      => ['label' => 'apellido(s)' ,'rules' => 'required|alpha_space'],
            'beneficiary_ci'            => ['label' => 'Carnet Identidad' ,'rules' => 'required|is_unique[beneficiaries.beneficiary_ci]|integer'],
        ]);

        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }

        $formuser = $this->request->getPost();
        
        $workWeek = "";

        $workWeek .= isset($formuser['lunes'])      ? ($formuser['lunes']     == "on" ? "1,":"") : "";
        $workWeek .= isset($formuser['martes'])     ? ($formuser['martes']    == "on" ? "2,":"") : "";
        $workWeek .= isset($formuser['miercoles'])  ? ($formuser['miercoles'] == "on" ? "3,":"") : "";
        $workWeek .= isset($formuser['jueves'])     ? ($formuser['jueves']    == "on" ? "4,":"") : "";
        $workWeek .= isset($formuser['viernes'])    ? ($formuser['viernes']   == "on" ? "5,":"") : "";
        $workWeek .= isset($formuser['sabado'])     ? ($formuser['sabado']    == "on" ? "6,":"") : "";
        $workWeek .= isset($formuser['domingo'])    ? ($formuser['domingo']   == "on" ? "7":"") : "";
        
        unset($formuser['lunes']);
        unset($formuser['martes']);
        unset($formuser['miercoles']);
        unset($formuser['jueves']);
        unset($formuser['viernes']);
        unset($formuser['sabado']);
        unset($formuser['domingo']);
        
        $register = [
            'beneficiary_workweek' => $workWeek,
            'status_id'     => 9,//9 En espera
        ];
        
        $postulantData = array_merge($formuser,$register);
        // var_dump($formuser);
        
        $postulant = new Beneficiary ($postulantData);
        $postulantModel = model('BeneficiaryModel');

        $postulantModel->insert($postulant);

        $postulantId = $postulantModel->getInsertId();

        // var_dump($postulantId);
        
        $contactModel = model('ContactModel');
        $formData = [
            'beneficiary_id'    => $postulantId,
            'contact_name'      => $postulantData['name_contact'],
            'contact_phone'     => $postulantData['phone_contact'],
        ];

        $contact = new Contact($formData);
        $contactModel->save($contact);

        $areasPostulant = $this->assemblyAreas($formuser);
        
        // var_dump($areasPostulant);

        if (count($areasPostulant) > 0) {
            $this->saveAreaParticipant($postulantId, $areasPostulant);
        }

        return redirect()->route('application_form')->with('msg',[
            'type' => 'green',
            'body' => 'El formulario se envio exitosamente!!!'
        ]);
    }

    function assemblyAreas($form){
        $areas = [];
        $areaModel = model('AreaModel');
        $activeAreas = $areaModel->where('status_id',1)->select('area_id')->findAll();
        foreach ($activeAreas as $activeArea) {
            if(isset($form["area_{$activeArea['area_id']}"]) && $form["area_{$activeArea['area_id']}"] == "on"){
                array_push($areas, $activeArea['area_id']);
            }
        }
        echo json_encode($areas);
        return $areas;
    }

    function saveAreaParticipant($beneficiary_id, $areasPostulant){
        $kardexModel = model('KardexModel');

        foreach ($areasPostulant as $ap) {
            $area_id = $ap;
            if(!$kardex = $kardexModel->where('beneficiary_id', $beneficiary_id)->select('kardices.kardex_id,kardices.beneficiary_area')->first()){
                $formData = [
                    'beneficiary_id'        => $beneficiary_id,
                    'beneficiary_area'      => "$area_id",
                ];
                $kardex = new Kardex($formData);
                $kardexModel->save($kardex);
            }else{
                if(!strstr($kardex['beneficiary_area'],"$area_id")){
                        $formData = [
                            'kardex_id'             => $kardex['kardex_id'],
                            'beneficiary_id'        => $beneficiary_id,
                            'beneficiary_area'      => "{$kardex['beneficiary_area']},$area_id",
                        ];
                        $kardexModel->save($formData);
                }
            }
        }
    }

    function replaceStringElement($originalString, $searchElement, $replaceElement) {
        $newString = str_replace($searchElement, $replaceElement, $originalString);        
        return $newString;
    }
}
