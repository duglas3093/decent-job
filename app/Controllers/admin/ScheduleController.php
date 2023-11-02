<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Schedule;
use CodeIgniter\Exceptions\PageNotFoundException;

class ScheduleController extends BaseController
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
        $scheduleModel = model('ScheduleModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $data['schedules'] = $scheduleModel
                            ->join('status s','s.status_id = schedules.status_id','LEFT')
                            ->select('schedules.*, s.status_name')
                            ->findAll();
        return view('admin/schedule/index',$data);
    }
    
    public function add(){
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $statusModel = model('StatusModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        
        return view('admin/schedule/add',$data);
    }

    public function edit(int $schedule_id){
        $scheduleModel = model('ScheduleModel');
        if(!$data['schedule'] = $scheduleModel->where('schedule_id', $schedule_id)->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $statusModel = model('StatusModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        return view('admin/schedule/edit',$data);
    }

    public function store(){
        $validation = service('validation');
        $validation->setRules([
            'schedule_description'          => ['label' => 'descripion','rules' => 'required'],
        ]);

        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }

        $schedule = new Schedule($this->request->getPost());
        $scheduleModel = model('ScheduleModel');

        $scheduleModel->save($schedule);
        return redirect()->route('admin/schedules')->with('msg',[
            'type' => 'green',
            'body' => 'Nuevo horario registrado exitosamente!'
        ]);
    }

    public function update(){
        $validation = service('validation');
        $validation->setRules([
            'schedule_description'          => ['label' => 'descripion','rules' => 'required'],
        ]);
        
        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }
        
        $model = model('ScheduleModel');
        if(!$model->where('schedule_id', (int)trim($this->request->getVar('schedule_id')))->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        $model->save([
            'schedule_id'           => trim($this->request->getVar('schedule_id')),
            'schedule_description'  => trim($this->request->getVar('schedule_description')),
            'status_id'             => trim($this->request->getVar('status_id'))
        ]);
        return redirect()->route('admin/schedules')->with('msg',[
            'type'=>'green',
            'body'=> 'El horario se actualizo exitosamente.'
        ]);   
    }
}
