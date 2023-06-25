<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class Login extends BaseController
{
    public function index()
    {
        if (!session()->is_logged){
            return view('auth/login');
        }
        return redirect()->route('admin/dashboard');
        // session()->destroy();
    }

    public function signin(){
        // dd($this->request->getPost());
        if (!$this->validate([
            'user_email' => 'required|valid_email',
            'user_password' => 'required',
        ])){
            return redirect()->back()
                    ->with('errors', $this->validator->getErrors())
                    ->withInput();
        }

        $email = trim($this->request->getVar('user_email'));
        $password = trim($this->request->getVar('user_password'));

        $model = model('UserModel');

        if(!$user = $model->getUserBy('user_email',$email)){
            return redirect()->back()
                    ->with('msg',[
                        'type'=>'red',
                        'body'=> 'Este usuario no se encuentra registrado en el sistema.'
                    ])
                    ->withInput();                    
        }
        
        if(!password_verify($password, $user['user_password'])){
            return redirect()->back()
                    ->with('msg',[
                        'type'=>'red',
                        'body'=> 'Credenciales invalidas.'
                    ])
                    ->withInput();
        }

        session()->set([
            'user_id' => $user['user_id'],
            'user_name' => $user['user_name'],
            'user_lastname' => $user['user_lastname'],
            'rol' => $user['rol_id'],
            'rol_url' => $user['rol_id'] == 1 ? 'admin':'sub-admin',
            'is_logged' => true,
        ]);
        
        return redirect()->route('admin/dashboard')->with('msg',[
            'type'=>'green',
            'body'=> 'Bienvenido nuevamente '.$user['user_name']
        ]);
    }

    public function signout(){
        session()->destroy();
        return redirect()->route('login');
    }

}