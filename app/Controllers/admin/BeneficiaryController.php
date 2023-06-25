<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Beneficiary;
use CodeIgniter\Exceptions\PageNotFoundException;

class BeneficiaryController extends BaseController
{
    private $session;
    private const PAGINATION = 1000;
    private const STATUS = 4;

    public function __construct(){
        $session = session()->get();
    }

    public function index(){
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $vulnerabilityModel = model('VulnerabilityModel');
        $data['vulnerabilities'] = $vulnerabilityModel->where('status_id', 1)->findAll();
        $beneficiaryModel = model('BeneficiaryModel');
        $data['beneficiaries'] = $beneficiaryModel
                            ->join('status s','s.status_id = beneficiaries.status_id','LEFT')
                            ->join('cities c','c.city_id = beneficiaries.city_id','LEFT')
                            ->join('kardices k','k.beneficiary_id = beneficiaries.beneficiary_id','LEFT')
                            ->select('beneficiaries.*, s.status_name, c.city_name,k.kardex_id')
                            ->where('beneficiaries.status_id', 1)
                            ->orderBy('beneficiary_lastname')
                            ->paginate(self::PAGINATION);
        // $data['pager'] = $userModel->pager;
        return view('admin/beneficiary/index',$data);
    }
    
    public function postulants(){
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $beneficiaryModel = model('BeneficiaryModel');
        $data['beneficiaries'] = $beneficiaryModel
                            ->join('status s','s.status_id = beneficiaries.status_id','LEFT')
                            ->join('cities c','c.city_id = beneficiaries.city_id','LEFT')
                            ->join('kardices k','k.beneficiary_id = beneficiaries.beneficiary_id','LEFT')
                            ->select('beneficiaries.*, s.status_name, c.city_name,k.kardex_id')
                            ->where('beneficiaries.status_id', 9)
                            ->orderBy('beneficiary_lastname')
                            ->paginate(self::PAGINATION);
        return view('admin/beneficiary/postulant',$data);
    }
    
    public function add(){
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $statusModel = model('StatusModel');
        $cityModel = model('CityModel');
        $scheduleModel = model('ScheduleModel');
        $socialMediaModel = model('SocialMediaModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        $data['social_medias'] = $socialMediaModel->where('status_id',1)->findAll();
        $data['schedules'] = $scheduleModel->where('status_id',1)->findAll();
        $data['cities'] = $cityModel->findAll();
        
        return view('admin/beneficiary/add',$data);
    }

    public function edit(int $beneficairy_id){
        $beneficiaryModel = model('BeneficiaryModel');
        if(!$data['beneficiary'] = $beneficiaryModel->where('beneficiary_id', $beneficairy_id)->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $statusModel = model('StatusModel');
        $cityModel = model('CityModel');
        $scheduleModel = model('ScheduleModel');
        $socialMediaModel = model('SocialMediaModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        $data['social_medias'] = $socialMediaModel->where('status_id',1)->findAll();
        $data['schedules'] = $scheduleModel->where('status_id',1)->findAll();
        $data['cities'] = $cityModel->findAll();
        return view('admin/beneficiary/edit',$data);
    }
    
    public function getPostulant(int $beneficiary_id){
        $beneficiaryModel = model('BeneficiaryModel');
        if(!$beneficiary = $beneficiaryModel->where('beneficiary_id', $beneficiary_id)->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        $data['beneficiary'] = $beneficiaryModel->join('schedules s','s.schedule_id = beneficiaries.schedule_id','LEFT')
                                                ->join('cities c','c.city_id = beneficiaries.city_id','LEFT')
                                                ->join('social_medias sm','sm.sm_id = beneficiaries.sm_id','LEFT')
                                                ->select('beneficiaries.*, s.schedule_description, c.city_name, sm_name')
                                                ->where('beneficiary_id', $beneficiary_id)
                                                ->first();
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $statusModel = model('StatusModel');
        $cityModel = model('CityModel');
        $scheduleModel = model('ScheduleModel');
        $socialMediaModel = model('SocialMediaModel');
        $vulnerabilityModel = model('VulnerabilityModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        $data['social_medias'] = $socialMediaModel->where('status_id',1)->findAll();
        $data['schedules'] = $scheduleModel->where('status_id',1)->findAll();
        $data['vulnerabilities'] = $vulnerabilityModel->where('status_id',1)->findAll();
        $data['cities'] = $cityModel->findAll();
        return view('admin/beneficiary/infoPostulant',$data);
    }

    public function store(){
        $validation = service('validation');
        $validation->setRules([
            'beneficiary_name'          => ['label' => 'nombre(s)','rules' => 'required'],
            'beneficiary_lastname'      => ['label' => 'apellido(s)' ,'rules' => 'required|alpha_space'],
            'beneficiary_ci'            => ['label' => 'Carnet Identidad' ,'rules' => 'required|is_unique[users.user_ci]|integer'],
            'beneficiary_celphone'      => ['label' => 'Telefono' ,'rules' => 'required_with[user_celphone]'],
            'beneficiary_email'         => ['label' => 'email' ,'rules' => 'required_with[user_email]'],
            'beneficiary_datebirth'     => ['label' => 'fecha de nacimiento' ,'rules' => 'required_with[user_email]'],
            'beneficiary_direction'     => ['label' => 'dirección' ,'rules' => 'required_with[user_email]'],
            'city_id'                   => ['label' => 'ciudad' ,'rules' => 'required'],
            'schedule_id'               => ['label' => 'horario' ,'rules' => 'required'],
            'sm_id'                     => ['label' => 'sm' ,'rules' => 'required'],
            // 'status_id'             => ['label' => 'rol' ,'rules' => 'required'],
        ]);

        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }
        $formuser = $this->request->getPost();
        // $formuser['user_password'] = password_hash($formuser['user_password'],PASSWORD_ARGON2ID);
        $register = [
            'status_id'     => 1,//1 active
        ];
        
        $beneficiaryData = array_merge($formuser,$register);
        $beneficiary = new Beneficiary ($beneficiaryData);
        $beneficiaryModel = model('BeneficiaryModel');

        $beneficiaryModel->save($beneficiary);
        return redirect()->route('admin/beneficiaries')->with('msg',[
            'type' => 'green',
            'body' => 'Beneficiario registrado con exito!'
        ]);
    }

    public function update(){
        $validation = service('validation');
        $validation->setRules([
            'beneficiary_name'          => ['label' => 'nombre(s)','rules' => 'required'],
            'beneficiary_lastname'      => ['label' => 'apellido(s)' ,'rules' => 'required|alpha_space'],
            'beneficiary_ci'            => ['label' => 'Carnet Identidad' ,'rules' => 'required|is_unique[users.user_ci]|integer'],
            'beneficiary_celphone'      => ['label' => 'Telefono' ,'rules' => 'required_with[user_celphone]'],
            'beneficiary_email'         => ['label' => 'email' ,'rules' => 'required_with[user_email]'],
            'beneficiary_datebirth'     => ['label' => 'fecha de nacimiento' ,'rules' => 'required_with[user_email]'],
            'beneficiary_direction'     => ['label' => 'dirección' ,'rules' => 'required_with[user_email]'],
            'city_id'                   => ['label' => 'ciudad' ,'rules' => 'required'],
            'schedule_id'               => ['label' => 'horario' ,'rules' => 'required'],
            'sm_id'                     => ['label' => 'sm' ,'rules' => 'required'],
        ]);
        
        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }
        
        $model = model('BeneficiaryModel');
        if(!$model->where('beneficiary_id', (int)trim($this->request->getVar('beneficiary_id')))->first()){
            throw PageNotFoundException::forPageNotFound();
        }

        // $loadImage = $this->_upload();

        $model->save([
            'beneficiary_id'            => trim($this->request->getVar('beneficiary_id')),
            'beneficiary_name'          => trim($this->request->getVar('beneficiary_name')),
            'beneficiary_lastname'      => trim($this->request->getVar('beneficiary_lastname')),
            'beneficiary_ci'            => trim($this->request->getVar('beneficiary_ci')),
            'beneficiary_celphone'      => trim($this->request->getVar('beneficiary_celphone')),
            'beneficiary_email'         => trim($this->request->getVar('beneficiary_email')),
            'beneficiary_datebirth'     => trim($this->request->getVar('beneficiary_datebirth')),
            'beneficiary_direction'     => trim($this->request->getVar('beneficiary_direction')),
            'city_id'                   => trim($this->request->getVar('city_id')),
            'schedule_id'               => trim($this->request->getVar('schedule_id')),
            'sm_id'                     => trim($this->request->getVar('sm_id')),
            'status_id'                 => (int)trim($this->request->getVar('status_id')),
        ]);
        return redirect()->route('admin/beneficiaries')->with('msg',[
            'type'=>'green',
            'body'=> 'El beneficiario se actualizo exitosamente.'
        ]);
    }


    public function approvePostulant($beneficiary_id){

        $model = model('BeneficiaryModel');
        if(!$beneficiary = $model->where('beneficiary_id', $beneficiary_id)->first()){
            throw PageNotFoundException::forPageNotFound();
        }

        $model->save([
            'beneficiary_id'            => $beneficiary_id,
            'status_id'                 => 1 //Active
        ]);

        return redirect()->route('admin/postulants')->with('msg',[
            'type'=>'green',
            'body'=> "El postulante {$beneficiary['beneficiary_name']} {$beneficiary['beneficiary_lastname']} ha sido aceptado exitosamente."
        ]);
    }
    
    public function dropPostulant($beneficiary_id){

        $model = model('BeneficiaryModel');

        if(!$beneficiary = $model->where('beneficiary_id', $beneficiary_id)->first()){
            throw PageNotFoundException::forPageNotFound();
        }

        $model->save([
            'beneficiary_id'            => $beneficiary_id,
            'status_id'                 => 10 //Reject
        ]);

        return redirect()->route('admin/postulants')->with('msg',[
            'type'=>'red',
            'body'=> "El postulante {$beneficiary['beneficiary_name']} {$beneficiary['beneficiary_lastname']} ha sido rechazado."
        ]);
    }
}
