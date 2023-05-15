<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ReportController extends BaseController{
    public function index(){
        $areaModel = model('AreaModel');
        $vulnerabilityModel = model('VulnerabilityModel');
        $supportModel = model('SuportModel');
        $companyModel = model('CompanyModel');


        $data['session'] = session()->get();
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $data['report_areas'] = $areaModel->findAll();
        $data['vulnerabilities'] = $vulnerabilityModel->where('status_id', 1)->findAll();
        $data['supports'] = $supportModel->where('status_id', 1)->findAll();
        $data['companies'] = $companyModel->findAll();

        return view('admin/report/index',$data);
    }


}
