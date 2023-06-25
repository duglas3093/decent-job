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
        // $db = \Config\Database::connect();

        // $query = "SELECT 
        //             CASE  THEN 'Nuevo' 
        //                 ELSE 'Antiguo' 
        //             END AS tbeneficiary,
        //             b.beneficiary_id,
        //             b.beneficiary_id,
        //             b.beneficiary_name,
        //             b.beneficiary_lastname,
        //             CONCAT(b.beneficiary_ci, b.beneficiary_complement) AS carnet,
        //             s.support_name,
        //             GROUP_CONCAT(st.status_name SEPARATOR '<br>') AS status,
        //             GROUP_CONCAT(s.support_name SEPARATOR '<br>') AS tipo
        //         FROM kardexdetails kd
        //         LEFT JOIN kardices k ON k.kardex_id = kd.kardex_id
        //         LEFT JOIN beneficiaries b ON b.beneficiary_id = k.beneficiary_id
        //         LEFT JOIN supports s ON kd.support_id = s.support_id
        //         LEFT JOIN status st ON kd.status_id = st.status_id
        //         WHERE kd.area_id IS NOT NULL
        //             AND kd.area_id = 
        //         GROUP BY b.beneficiary_id;";
        
        // $data['beneficiary'] = $db->query($query)->getResultArray();

        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        return view('admin/dashboard/index',$data);
    }
}
