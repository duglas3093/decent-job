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
        $db = \Config\Database::connect();

        $query =    "SELECT area.one_area,area.two_areas,area.more_two_areas,benefi.total_beneficiaries
                    from (
                        SELECT 1 as id,
                            COUNT(CASE WHEN LENGTH(k.beneficiary_area) <= 2 THEN 1 END) AS one_area,
                            COUNT(CASE WHEN LENGTH(k.beneficiary_area) = 3 THEN 1 END) AS two_areas,
                            COUNT(CASE WHEN LENGTH(k.beneficiary_area) >= 4 THEN 1 END) AS more_two_areas
                        FROM
                            kardices k
                        WHERE EXISTS (SELECT 1 FROM beneficiaries b  WHERE b.beneficiary_id = k.beneficiary_id and b.status_id=1)
                        ) as area
                    join (
                        SELECT 1 as id,count(b2.beneficiary_id) as total_beneficiaries 
                        from beneficiaries b2 
                        WHERE b2.status_id = 1
                    ) as benefi";
        
        $data['beneficiary'] = $db->query($query)->getResultArray()[0];

        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        return view('admin/dashboard/index',$data);
    }
}