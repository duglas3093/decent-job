<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Suport;
use CodeIgniter\Exceptions\PageNotFoundException;

class SuportController extends BaseController
{
    private $session;
    private const PAGINATION = 100;
    private const STATUS = 4;

    public function __construct(){
        $session = session()->get();
    }

    public function index(){
        $areaModel = model('AreaModel');
        $suportModel = model('SuportModel');
        $data['session'] = session()->get();
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $data['supports'] = $suportModel
                            ->join('status s','s.status_id = supports.status_id','LEFT')
                            ->join('areas a','a.area_id = supports.area_id','LEFT')
                            ->select('supports.*, s.status_name, a.area_name')
                            ->paginate(self::PAGINATION);
        return view('admin/suport/index',$data);
    }
    
    public function add(){
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $data['support_areas'] = $areaModel->findAll();
        $statusModel = model('StatusModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        
        return view('admin/suport/add',$data);
    }

    public function edit(int $suport_id){
        $suportModel = model('SuportModel');
        if(!$data['support'] = $suportModel->where('support_id', $suport_id)->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $data['support_areas'] = $areaModel->findAll();
        $statusModel = model('StatusModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        return view('admin/suport/edit',$data);
    }

    public function store(){
        $validation = service('validation');
        $validation->setRules([
            'support_name'    => ['label' => 'name','rules' => 'required'],
        ]);

        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }

        $form = $this->request->getPost();
        $register = [
            'status_id'     => 1,//1 active
        ];
        
        $suportData = array_merge($form,$register);
        $suport = new Suport($suportData);
        $suportModel = model('SuportModel');

        $suportModel->save($suport);
        return redirect()->route('admin/supports')->with('msg',[
            'type' => 'green',
            'body' => 'Nuevo tipo de ayuda registrado exitosamente!'
        ]);
    }

    public function update(){
        $validation = service('validation');
        $validation->setRules([
            'support_name'   => ['label' => 'descripción' ,'rules' => 'required'],
        ]);
        
        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }
        
        $model = model('SuportModel');
        if(!$model->where('support_id', (int)trim($this->request->getVar('support_id')))->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        $model->save([
            'support_id'            => trim($this->request->getVar('support_id')),
            'support_name'          => trim($this->request->getVar('support_name')),
            'support_description'   => trim($this->request->getVar('support_description')),
            'area_id'               => trim($this->request->getVar('area_id')),
            'status_id'             => (int)trim($this->request->getVar('status_id')),
        ]);
        return redirect()->route('admin/supports')->with('msg',[
            'type'=>'green',
            'body'=> 'El tipo de ayuda  se actualizo exitosamente.'
        ]);   
    }
}
