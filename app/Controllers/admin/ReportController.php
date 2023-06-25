<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ReportController extends BaseController{

    function __construct(){
    }

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

    public function getReport(){
        $db = \Config\Database::connect();

        $area_id = $this->request->getPost('area');
        // $support_id = $this->request->getPost('support');
        $dateInit = $this->request->getPost('dateInit');
        $dateEnd = $this->request->getPost('dateEnd');

        $date1 = $dateInit != '' ? "AND kd.created_at >= '$dateInit'" : "";
        $date2 = $dateEnd != '' ? "AND kd.created_at <= '$dateEnd'" : "";

        $query = "SELECT 
                    CASE 
                        WHEN b.updated_at >= '$dateInit' THEN 'Nuevo' 
                        ELSE 'Antiguo' 
                    END AS tbeneficiary,
                    b.beneficiary_id,
                    b.beneficiary_id,
                    b.beneficiary_name,
                    b.beneficiary_lastname,
                    CONCAT(b.beneficiary_ci, b.beneficiary_complement) AS carnet,
                    s.support_name,
                    GROUP_CONCAT(st.status_name SEPARATOR '<br>') AS status,
                    GROUP_CONCAT(s.support_name SEPARATOR '<br>') AS tipo,
                    group_concat(kd.updated_at separator '<br>') as updated
                FROM kardexdetails kd
                LEFT JOIN kardices k ON k.kardex_id = kd.kardex_id
                LEFT JOIN beneficiaries b ON b.beneficiary_id = k.beneficiary_id
                LEFT JOIN supports s ON kd.support_id = s.support_id
                LEFT JOIN status st ON kd.status_id = st.status_id
                WHERE kd.area_id IS NOT NULL
                    AND kd.area_id = $area_id
                    $date1
                    $date2
                GROUP BY b.beneficiary_id;";
        
        $reports = $db->query($query)->getResultArray();
        echo json_encode($reports);
    }
}
