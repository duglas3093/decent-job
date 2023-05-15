<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Company;
use CodeIgniter\Exceptions\PageNotFoundException;

class CompanyController extends BaseController
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
        $companyModel = model('CompanyModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $data['companies'] = $companyModel
                            ->findAll();
                            // ->paginate(self::PAGINATION);
        return view('admin/company/index',$data);
    }
    
    public function add(){
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $statusModel = model('StatusModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        
        return view('admin/company/add',$data);
    }

    public function edit(int $company_id){
        $companyModel = model('CompanyModel');
        if(!$data['company'] = $companyModel->where('company_id', $company_id)->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        // $statusModel = model('StatusModel');
        // $data['status'] = $statusModel->where('status_category',1)->findAll();
        return view('admin/company/edit',$data);
    }

    public function store(){
        $validation = service('validation');
        $validation->setRules([
            'company_name'          => ['label' => 'nombre','rules' => 'required'],
        ]);

        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }

        $company = new Company($this->request->getPost());
        $companyModel = model('CompanyModel');

        $companyModel->save($company);
        return redirect()->route('admin/companies')->with('msg',[
            'type' => 'green',
            'body' => 'Nueva empresa registrada exitosamente!'
        ]);
    }

    public function update(){
        $validation = service('validation');
        $validation->setRules([
            'company_name'          => ['label' => 'nombre','rules' => 'required'],
        ]);
        
        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }
        
        $model = model('CompanyModel');
        if(!$model->where('company_id', (int)trim($this->request->getVar('company_id')))->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        $model->save([
            'company_id'            => trim($this->request->getVar('company_id')),
            'company_name'          => trim($this->request->getVar('company_name')),
            'company_phone'         => trim($this->request->getVar('company_phone')),
            'company_description'   => trim($this->request->getVar('company_description')),
            'company_direction'     => trim($this->request->getVar('company_direction')),
        ]);
        return redirect()->route('admin/companies')->with('msg',[
            'type'=>'green',
            'body'=> 'La empresa se actualizo exitosamente.'
        ]);   
    }
}