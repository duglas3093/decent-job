<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\KardexDetail;
use CodeIgniter\Exceptions\PageNotFoundException;

class KardexDetailController extends BaseController
{
    public function supportBeneficiary(){
        $beneficiary_id = $this->request->getPost('beneficiary');
        $kardex_id = $this->request->getPost('kardex');
        $area_id = $this->request->getPost('area');
        $kardexDetailModel = model('KardexDetailModel');

        $beneficiarySupports = $kardexDetailModel
                                            ->join('supports s', 's.support_id = kardexdetails.support_id', 'LEFT')
                                            ->join('status st', 'st.status_id = kardexdetails.status_id','LEFT')
                                            ->where('kardexdetails.kardex_id', $kardex_id)
                                            ->where('kardexdetails.area_id', $area_id)
                                            ->select('kardexdetails.detkar_id,s.support_name, st.status_name')
                                            ->findAll();
        
        echo json_encode($beneficiarySupports);
    }

    public function edit(){
        $detkar_id = $this->request->getPost('detkar_id');
        $kardexDetailModel = model('KardexDetailModel');
        if(!$detkar = $kardexDetailModel->where('detkar_id', $detkar_id)->first()){
            throw PageNotFoundException::forPageNotFound();
        }
                
        echo json_encode($detkar);
    }
    
    public function store(){
        $beneficiary_id = $this->request->getPost('beneficiary');
        $kardex_id = $this->request->getPost('kardex');
        $status_id = $this->request->getPost('status');
        $support_id = $this->request->getPost('support');
        $area_id = $this->request->getPost('area');
        $detkar_description = $this->request->getPost('detkar_description');
        $kardexDetailModel = model('KardexDetailModel');
        $formData = [
            'kardex_id'             => $kardex_id,
            'area_id'               => $area_id,
            'support_id'            => $support_id,
            'detkar_description'    => $detkar_description,
            'status_id'             => $status_id
        ];
        $kardexDetail = new KardexDetail($formData);
        $kardexDetailModel->save($kardexDetail);
        
        echo json_encode("ok");
    }

    private function strToArray($str){
        $array = explode(',', $str);
        return $array;
    }
}
