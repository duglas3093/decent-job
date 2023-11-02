<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Beneficiary;
use App\Entities\Contact;
use App\Entities\Postulant;

class PostulantController extends BaseController
{
    public function add(){
        $data['session'] = session()->get();
        $statusModel = model('StatusModel');
        $cityModel = model('CityModel');
        $scheduleModel = model('ScheduleModel');
        $socialMediaModel = model('SocialMediaModel');
        $compromiseModel = model('CompromiseModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        $data['social_medias'] = $socialMediaModel->where('status_id',1)->findAll();
        $data['schedules'] = $scheduleModel->where('status_id',1)->findAll();
        $data['cities'] = $cityModel->findAll();
        $data['compromises'] = $compromiseModel->findAll();
        
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
        // var_dump($postulantData);
        
        
        $postulant = new Beneficiary ($postulantData);
        $postulantModel = model('BeneficiaryModel');

        $postulantModel->insert($postulant);

        $postulantId = $postulantModel->getInsertId();

        $contactModel = model('ContactModel');
        $formData = [
            'beneficiary_id'    => $postulantId,
            'contact_name'      => $postulantData['name_contact'],
            'contact_phone'     => $postulantData['phone_contact'],
        ];

        $contact = new Contact($formData);
        $contactModel->save($contact);

        return redirect()->route('application_form')->with('msg',[
            'type' => 'green',
            'body' => 'El formulario se envio exitosamente!!!'
        ]);
    }
}
