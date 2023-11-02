<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\User;
use CodeIgniter\Exceptions\PageNotFoundException;

class UserController extends BaseController
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
        $userModel = model('UserModel');
        $data['users'] = $userModel
                            ->join('status s','s.status_id = users.status_id','LEFT')
                            ->join('rols r','r.rol_id = users.rol_id','LEFT')
                            ->select('users.*, s.status_name, r.rol_description')
                            ->orderBy('user_lastname')
                            ->paginate(self::PAGINATION);
        // $data['pager'] = $userModel->pager;
        return view('admin/user/index',$data);
        // var_dump(json_encode(json_encode($data['users'], true)));   
        // $data['courses'] = $courseModel
        //                     ->join('instructor i','i.instructor_id = courses.instructor_id','LEFT')
        //                     ->join('status s','s.status_id = courses.status_id','LEFT')
        //                     ->join('categories c','c.category_id = courses.category_id','LEFT')
        //                     ->select('courses.*,i.instructor_name,s.status_description,c.category_description')
        //                     ->where('courses.status_id',self::STATUS)
        //                     ->paginate(self::PAGINATION);
    }
    
    public function add(){
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $statusModel = model('StatusModel');
        $rolModel = model('RolsModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        $data['rols'] = $rolModel->findAll();
        
        return view('admin/user/add',$data);
    }

    public function edit(int $user_id){
        $userModel = model('UserModel');
        if(!$data['user'] = $userModel->where('user_id', $user_id)->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $statusModel = model('StatusModel');
        $rolModel = model('RolsModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        $data['rols'] = $rolModel->findAll();
        return view('admin/user/edit',$data);
    }

    public function store(){
        $validation = service('validation');
        $validation->setRules([
            'user_name'          => ['label' => 'nombre(s)','rules' => 'required'],
            'user_lastname'      => ['label' => 'apellido(s)' ,'rules' => 'required|alpha_space'],
            'user_ci'            => ['label' => 'Carnet Identidad' ,'rules' => 'required|is_unique[users.user_ci]|integer'],
            'user_celphone'      => ['label' => 'Telefono' ,'rules' => 'required_with[user_celphone]'],
            'user_email'         => ['label' => 'email' ,'rules' => 'required_with[user_email]'],
            'user_password'      => ['label' => 'contraseña' ,'rules' => 'required'],
            'rol_id'             => ['label' => 'rol' ,'rules' => 'required'],
        ]);

        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }
        $formuser = $this->request->getPost();
        $formuser['user_password'] = password_hash($formuser['user_password'],PASSWORD_ARGON2ID);
        $register = [
            'status_id'     => 1,//1 active
        ];
        
        $userData = array_merge($formuser,$register);
        $user = new User($userData);
        $userModel = model('UserModel');

        $userModel->save($user);
        return redirect()->route('admin/users')->with('msg',[
            'type' => 'green',
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
    public function changePassword(){
        $user = $this->request->getPost('user');
        $newPassword = $this->request->getPost('newPassword');
        
        $userModel = model('UserModel');
        
        $hashPassword = password_hash("$newPassword",PASSWORD_ARGON2ID);

        $userModel->save([
            'user_id'               => $user,
            'user_password'         => $hashPassword
        ]);

        echo json_encode("ok");
    }
}
