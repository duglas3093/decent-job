<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Beneficiary;
use CodeIgniter\Exceptions\PageNotFoundException;

class BeneficiaryController extends BaseController
{
    private $session;
    private const PAGINATION = 10;
    private const STATUS = 4;

    public function __construct(){
        $session = session()->get();
    }

    public function index(){
        $data['session'] = session()->get();
        $beneficiaryModel = model('BeneficiaryModel');
        $data['beneficiaries'] = $beneficiaryModel
                            ->join('status s','s.status_id = beneficiaries.status_id','LEFT')
                            ->join('cities c','c.city_id = beneficiaries.city_id','LEFT')
                            ->select('beneficiaries.*, s.status_name, c.city_name')
                            ->orderBy('beneficiary_lastname')
                            ->paginate(self::PAGINATION);
        // $data['pager'] = $userModel->pager;
        return view('admin/beneficiary/index',$data);
    }
    
    public function add(){
        $data['session'] = session()->get();
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

    public function edit(int $user_id){
        $userModel = model('UserModel');
        if(!$data['user'] = $userModel->where('user_id', $user_id)->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        $data['session'] = session()->get();
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
            'type' => 'success',
            'body' => 'Usuario registrado con exito!'
        ]);
    }

    public function update(){
        $validation = service('validation');
        $validation->setRules([
            'user_name'          => ['label' => 'nombre(s)','rules' => 'required'],
            'user_lastname'      => ['label' => 'apellido(s)' ,'rules' => 'required|alpha_space'],
            'user_ci'            => ['label' => 'Carnet Identidad' ,'rules' => 'required|integer'],
            'user_celphone'      => ['label' => 'Telefono' ,'rules' => 'required_with[user_celphone]'],
            'user_email'         => ['label' => 'email' ,'rules' => 'required_with[user_email]'],
            // 'user_password'      => ['label' => 'contraseña' ,'rules' => 'required'],
            'rol_id'             => ['label' => 'rol' ,'rules' => 'required'],
        ]);
        
        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }
        
        $model = model('UserModel');
        if(!$model->where('user_id', (int)trim($this->request->getVar('user_id')))->first()){
            throw PageNotFoundException::forPageNotFound();
        }

        // $loadImage = $this->_upload();

        $model->save([
            'user_id'            => trim($this->request->getVar('user_id')),
            'user_name'          => trim($this->request->getVar('user_name')),
            'user_lastname'      => trim($this->request->getVar('user_lastname')),
            'user_ci'            => trim($this->request->getVar('user_ci')),
            'user_celphone'      => trim($this->request->getVar('user_celphone')),
            'user_email'         => trim($this->request->getVar('user_email')),
            'rol_id'             => trim($this->request->getVar('rol_id')),
            'status_id'          => (int)trim($this->request->getVar('status_id')),
        ]);
        return redirect()->route('admin/users')->with('msg',[
            'type'=>'green',
            'body'=> 'El usuario se actualizo exitosamente.'
        ]);
        
    }

    // private function _upload(){
    //     $newName = "";
    //     if ($imageFile = $this->request->getFile('user_photo')) {
    //         if ($imageFile->isValid() && !$imageFile->hasMoved()) {
    //             $newName = $imageFile->getRandomName();
    //             $imageFile->move(ROOTPATH."public/uploads/images/users/",$newName);
    //         }
    //     }
    //     return $newName;
    // }
}
