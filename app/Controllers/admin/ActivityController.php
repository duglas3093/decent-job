<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Activity;
use CodeIgniter\Exceptions\PageNotFoundException;

class ActivityController extends BaseController
{
    private $session;
    private const PAGINATION = 1000;
    private const STATUS = 4;

    public function __construct(){
        $session = session()->get();
    }

    public function index(){
        $areaModel = model('AreaModel');
        $activityModel = model('ActivityModel');
        $data['session'] = session()->get();
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $data['activities'] = $activityModel
                                ->join('status s','s.status_id = activities.status_id','LEFT')
                                ->select('activities.*, s.status_name')
                                ->paginate(self::PAGINATION);
        return view('admin/activity/index',$data);
    }
    
    public function add(){
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $statusModel = model('StatusModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        
        return view('admin/activity/add',$data);
    }

    public function edit(int $activity_id){
        $activityModel = model('ActivityModel');
        if(!$data['activity'] = $activityModel->where('activity_id', $activity_id)->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        $areaModel = model('AreaModel');
        $statusModel = model('StatusModel');
        
        $data['session'] = session()->get();
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        return view('admin/activity/edit',$data);
    }

    public function store(){
        $validation = service('validation');
        $validation->setRules([
            'activity_name'          => ['label' => 'nombre(s)','rules' => 'required'],
        ]);

        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }

        $form = $this->request->getPost();
        $register = [
            'status_id'     => 1,//1 active
        ];
        
        $activityData = array_merge($form,$register);
        $activity = new Activity($activityData);
        $activityModel = model('ActivityModel');

        $activityModel->save($activity);
        return redirect()->route('admin/activities')->with('msg',[
            'type' => 'green',
            'body' => 'Nueva actividad registrada exitosamente!'
        ]);
    }

    public function update(){
        $validation = service('validation');
        $validation->setRules([
            'activity_name'          => ['label' => 'nombre(s)','rules' => 'required'],
        ]);
        
        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }
        
        $model = model('ActivityModel');
        if(!$model->where('activity_id', (int)trim($this->request->getVar('activity_id')))->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        $model->save([
            'activity_id'           => trim($this->request->getVar('activity_id')),
            'activity_name'         => trim($this->request->getVar('activity_name')),
            'activity_description'  => trim($this->request->getVar('activity_description')),
            'suport_id'             => trim($this->request->getVar('suport_id')),
            'status_id'             => (int)trim($this->request->getVar('status_id')),
        ]);
        return redirect()->route('admin/activities')->with('msg',[
            'type'=>'green',
            'body'=> 'La actvidad se actualizo exitosamente.'
        ]);   
    }
}
