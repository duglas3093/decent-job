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
        $support_id = $this->request->getPost('support');
        $dateInit = $this->request->getPost('dateInit');
        $dateEnd = $this->request->getPost('dateEnd');

        $date1 = $dateInit != '' ? "and kd.created_at >= '$dateInit'" : "";
        $date2 = $dateEnd != '' ? "and kd.created_at <= '$dateEnd'" : "";
        
        $query = "select kd.*,b.beneficiary_id  ,b.beneficiary_name ,b.beneficiary_lastname, GROUP_CONCAT(kd.detkar_description separator '-') as description, s.support_name, st.status_name  
                from kardexdetails kd 
                left join kardices k on k.kardex_id = kd.kardex_id
                left join beneficiaries b on b.beneficiary_id = k.beneficiary_id 
                left join supports s on kd.support_id = s.support_id 
                left join status st on kd.status_id = st.status_id  
                where kd.area_id = $area_id 
                $date1 
                $date2 
                group by b.beneficiary_id;";

        $data['reports'] = $db->query($query)->getResultArray();
        $kardexDetailModel = model('KardexDetailModel');

        // $kardexDetailModel->where('detkar_id', $detkar_id)->delete();

        echo json_encode($data);
    }
}
