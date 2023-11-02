<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\SocialNetwork;
use CodeIgniter\Exceptions\PageNotFoundException;

class SocialNetworkController extends BaseController
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
        $socialMediaModel = model('SocialMediaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $data['smedias'] = $socialMediaModel
                            ->join('status s','s.status_id = social_medias.status_id','LEFT')
                            ->select('social_medias.*, s.status_name')
                            ->findAll();
        return view('admin/social_network/index',$data);
    }
    
    public function add(){
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $statusModel = model('StatusModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        
        return view('admin/social_network/add',$data);
    }

    public function edit(int $sm_id){
        $socialMediaModel = model('SocialMediaModel');
        if(!$data['smedia'] = $socialMediaModel->where('sm_id', $sm_id)->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $statusModel = model('StatusModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        return view('admin/social_network/edit',$data);
    }

    public function store(){
        $validation = service('validation');
        $validation->setRules([
            'sm_name'          => ['label' => 'Name','rules' => 'required'],
        ]);

        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }

        $smedia = new SocialNetwork($this->request->getPost());
        $socialMediaModel = model('SocialMediaModel');

        $socialMediaModel->save($smedia);
        return redirect()->route('admin/social_network')->with('msg',[
            'type' => 'green',
            'body' => 'La nueva red social se registrado exitosamente!'
        ]);
    }

    public function update(){
        $validation = service('validation');
        $validation->setRules([
            'sm_name'          => ['label' => 'descripion','rules' => 'required'],
        ]);
        
        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }
        
        $model = model('SocialMediaModel');
        if(!$model->where('sm_id', (int)trim($this->request->getVar('sm_id')))->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        $model->save([
            'sm_id'         => trim($this->request->getVar('sm_id')),
            'sm_name'       => trim($this->request->getVar('sm_name')),
            'status_id'     => trim($this->request->getVar('status_id'))
        ]);
        return redirect()->route('admin/social_network')->with('msg',[
            'type'=>'green',
            'body'=> 'La red social se actualizo exitosamente.'
        ]);   
    }
}
