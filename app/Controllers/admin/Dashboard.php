<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function __construct(){
        $session = session()->get();
    }
    
    public function index()
    {
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        return view('admin/dashboard/index',$data);
    }
}
