<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Area;
use CodeIgniter\Exceptions\PageNotFoundException;

class AreaController extends BaseController
{
    private $session;
    private const PAGINATION = 100;
    private const STATUS = 4;

    public function __construct(){
        $session = session()->get();
    }

    public function index(){
        $areaModel = model('AreaModel');
        $companyModel = model('companyModel');
        $data['session'] = session()->get();
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $data['areas'] = $areaModel
                            ->join('status s','s.status_id = areas.status_id','LEFT')
                            ->select('areas.*, s.status_name')
                            ->paginate(self::PAGINATION);
        return view('admin/area/index',$data);
    }
    
    public function add(){
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $statusModel = model('StatusModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        
        return view('admin/area/add',$data);
    }

    public function edit(int $area_id){
        $areaModel = model('AreaModel');
        if(!$data['area'] = $areaModel->where('area_id', $area_id)->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $statusModel = model('StatusModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        return view('admin/area/edit',$data);
    }

    public function store(){
        $validation = service('validation');
        $validation->setRules([
            'area_name'          => ['label' => 'nombre(s)','rules' => 'required'],
            'area_description'   => ['label' => 'apellido(s)' ,'rules' => 'required|alpha_space'],
        ]);

        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }

        $formArea = $this->request->getPost();
        $areaSlug = $this->createSlug(trim($this->request->getVar('area_name')));
        $register = [
            'area_slug'     => $areaSlug,
            'status_id'     => 1,//1 active
        ];
        
        $areaData = array_merge($formArea,$register);
        $area = new Area($areaData);
        $areaModel = model('AreaModel');

        $areaModel->save($area);
        return redirect()->route('admin/areas')->with('msg',[
            'type' => 'green',
            'body' => 'Nueva Area registrada exitosamente!'
        ]);
    }

    public function update(){
        $validation = service('validation');
        $validation->setRules([
            'area_name'          => ['label' => 'nombre(s)','rules' => 'required'],
            'area_description'   => ['label' => 'apellido(s)' ,'rules' => 'required|alpha_space'],
        ]);
        
        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }
        
        $model = model('AreaModel');
        if(!$model->where('area_id', (int)trim($this->request->getVar('area_id')))->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        $areaSlug = $this->createSlug(trim($this->request->getVar('area_name')));
        $model->save([
            'area_id'            => trim($this->request->getVar('area_id')),
            'area_name'          => trim($this->request->getVar('area_name')),
            'area_description'   => trim($this->request->getVar('area_description')),
            'area_slug'          => $areaSlug,
            'status_id'          => (int)trim($this->request->getVar('status_id')),
        ]);
        return redirect()->route('admin/areas')->with('msg',[
            'type'=>'green',
            'body'=> 'El area se actualizo exitosamente.'
        ]);   
    }

    private function createSlug($str){
        $delimiter = '_';
        $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
        return $slug;
    }

    public function view_area($areaSlug, $areaId){
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $beneficiaryModel = model('BeneficiaryModel');
        $supportModel = model('SuportModel');
        $statusModel = model('StatusModel');
        $data['area_id'] = $areaId;
        $data['beneficiaries'] = $beneficiaryModel
                            ->join('kardices k', 'k.beneficiary_id = beneficiaries.beneficiary_id','LEFT')
                            ->join('status s','s.status_id = beneficiaries.status_id','LEFT')
                            ->join('cities c','c.city_id = beneficiaries.city_id','LEFT')
                            ->like('k.beneficiary_area',"%{$areaId}%")
                            ->select('beneficiaries.*, s.status_name, c.city_name, k.kardex_id')
                            ->orderBy('beneficiary_lastname')
                            ->paginate(self::PAGINATION);
        $data['supports'] = $supportModel->where('area_id',$areaId)->where('status_id',1)->findAll();
        $data['status'] = $statusModel->where('status_category',2)->findAll();
        return view('admin/beneficiary/beneficiaries_area',$data);
    }
}
