<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class CompromiseController extends BaseController
{
    private $session;
    private const PAGINATION = 10;
    private const STATUS = 4;

    public function __construct(){
        $session = session()->get();
    }

    public function index(){
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $compromiseModel = model('CompromiseModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $data['compromises'] = $compromiseModel
                            ->findAll();
        return view('admin/compromise/index',$data);
    }

    public function edit(int $compromise_id){
        $compromiseModel = model('CompromiseModel');
        $areaModel = model('AreaModel');
        
        if(!$data['compromise'] = $compromiseModel->where('compromise_id', $compromise_id)->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        
        $data['session'] = session()->get();
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();

        return view('admin/compromise/edit',$data);
    }

    public function update(){
        $validation = service('validation');
        $validation->setRules([
            'compromise_name'          => ['label' => 'nombre','rules' => 'required'],
            'compromise_description'          => ['label' => 'descripción','rules' => 'required'],
        ]);
        
        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }
        
        $model = model('CompromiseModel');
        if(!$model->where('compromise_id', (int)trim($this->request->getVar('compromise_id')))->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        $model->save([
            'compromise_id'            => trim($this->request->getVar('compromise_id')),
            'compromise_name'          => trim($this->request->getVar('compromise_name')),
            'compromise_description'   => trim($this->request->getVar('compromise_description')),
        ]);

        return redirect()->route('admin/compromises')->with('msg',[
            'type'=>'green',
            'body'=> 'El compromiso se actualizo exitosamente.'
        ]);   
    }
}
