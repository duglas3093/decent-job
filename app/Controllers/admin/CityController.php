<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\City;
use CodeIgniter\Exceptions\PageNotFoundException;

class CityController extends BaseController
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
        $cityModel = model('CityModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $data['cities'] = $cityModel
                            ->join('status s','s.status_id = cities.status_id','LEFT')
                            ->select('cities.*, s.status_name')
                            ->findAll();
        return view('admin/city/index',$data);
    }
    
    public function add(){
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $statusModel = model('StatusModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        
        return view('admin/city/add',$data);
    }

    public function edit(int $city_id){
        $cityModel = model('CityModel');
        if(!$data['city'] = $cityModel->where('city_id', $city_id)->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $statusModel = model('StatusModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        return view('admin/city/edit',$data);
    }

    public function store(){
        $validation = service('validation');
        $validation->setRules([
            'city_name'          => ['label' => 'Nombre','rules' => 'required'],
        ]);

        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }

        $city = new City($this->request->getPost());
        $cityModel = model('CityModel');

        $cityModel->save($city);
        return redirect()->route('admin/cities')->with('msg',[
            'type' => 'green',
            'body' => 'Nuevo horario registrado exitosamente!'
        ]);
    }

    public function update(){
        $validation = service('validation');
        $validation->setRules([
            'city_name'          => ['label' => 'Nombre','rules' => 'required'],
        ]);
        
        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }
        
        $model = model('CityModel');
        if(!$model->where('city_id', (int)trim($this->request->getVar('city_id')))->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        $model->save([
            'city_id'       => trim($this->request->getVar('city_id')),
            'city_name'     => trim($this->request->getVar('city_name')),
            'status_id'     => trim($this->request->getVar('status_id'))
        ]);
        return redirect()->route('admin/cities')->with('msg',[
            'type'=>'green',
            'body'=> 'El horario se actualizo exitosamente.'
        ]);   
    }
}
