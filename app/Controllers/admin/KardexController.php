<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Kardex;
use CodeIgniter\Exceptions\PageNotFoundException;

class KardexController extends BaseController
{
    public function viewKardex($beneficiary_id){
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $kardexModel = model('KardexModel');
        $beneficiaryModel = model('BeneficiaryModel');
        $kardexDetailModel = model('KardexDetailModel');
        
        if(!$data['kardex'] = $kardexModel->where('beneficiary_id', $beneficiary_id)->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        $data['beneficiary'] = $beneficiaryModel->join('schedules s','s.schedule_id = beneficiaries.schedule_id','LEFT')
                                                ->join('cities c','c.city_id = beneficiaries.city_id','LEFT')
                                                ->join('social_medias sm','sm.sm_id = beneficiaries.sm_id','LEFT')
                                                ->select('beneficiaries.*, s.schedule_description, c.city_name, sm_name')
                                                ->where('beneficiary_id', $beneficiary_id)
                                                ->first();
        $data['activities'] = $kardexDetailModel->join('kardices k','k.kardex_id = kardexdetails.kardex_id','LEFT')
                                                ->join('status s',' s.status_id = kardexdetails.status_id','LEFT')
                                                ->join('supports su', 'su.support_id = kardexdetails.support_id','LEFT')
                                                ->join('areas a', 'a.area_id = kardexdetails.area_id','LEFT')
                                                ->select('kardexdetails.*, s.status_name, a.area_name, su.support_name')
                                                ->orderBy('a.area_name','ASC')
                                                ->orderBy('kardexdetails.created_at','ASC')
                                                ->where('k.beneficiary_id',$beneficiary_id)
                                                ->findAll();
        $data['session'] = session()->get();
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();

        
        return view('admin/kardex/index',$data);
    }

    public function kardexBeneficiary(){
        $beneficiary_id = $this->request->getPost('beneficiary');
        $areaModel = model('AreaModel');
        $kardexModel = model('KardexModel');

        $areasBeneficiaryStr = $kardexModel->where('kardices.beneficiary_id', $beneficiary_id)->select('kardices.beneficiary_area')->first();
        $beneficiaryAreas = $this->strToArray($areasBeneficiaryStr['beneficiary_area']);
        $areas = [];
        foreach ($beneficiaryAreas as $ba) {
            array_push($areas, $areaModel->where('area_id',(int)$ba)->select('area_name')->first());
        }
        echo json_encode($areas);
    }
    
    public function viewKardexArea($kardexId, $areaId){
        $areaModel = model('AreaModel');
        $kardexModel = model('KardexModel');
        $kardexDetailModel = model('KardexDetailModel');
        $data['session'] = session()->get();
        
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();

        $data['beneficiary'] = $kardexModel->join('beneficiaries b', 'b.beneficiary_id = kardices.beneficiary_id','LEFT')
                                            ->where('kardices.kardex_id', $kardexId)
                                            ->select('b.beneficiary_name, b.beneficiary_lastname')
                                            ->first();

        $data['activities'] = $kardexDetailModel->join('supports s','kardexdetails.support_id = s.support_id','LEFT')
                                            ->join('status st','kardexdetails.status_id = st.status_id','LEFT')
                                            ->join('areas a','kardexdetails.area_id = a.area_id','LEFT')
                                            ->where('kardexdetails.kardex_id', $kardexId)
                                            ->where('kardexdetails.area_id', $areaId)
                                            ->select('kardexdetails.*,a.area_name ,s.support_name, st.status_name')
                                            ->findAll();

        return view('admin/kardex/activities_area',$data);
    }
    
    public function store(){
        $beneficiary_id = $this->request->getPost('beneficiary');
        $kardexModel = model('KardexModel');
        $area_id = $this->request->getPost('area');
        if(!$kardex = $kardexModel->where('beneficiary_id', $beneficiary_id)->select('kardices.kardex_id,kardices.beneficiary_area')->first()){
            $formData = [
                'beneficiary_id'        => $beneficiary_id,
                'beneficiary_area'      => "$area_id",
            ];
            $kardex = new Kardex($formData);
            $kardexModel->save($kardex);
        }else{
            if(!strstr($kardex['beneficiary_area'],"$area_id")){
                $formData = [
                    'kardex_id'             => $kardex['kardex_id'],
                    'beneficiary_id'        => $beneficiary_id,
                    'beneficiary_area'      => "{$kardex['beneficiary_area']},$area_id",
                ];
                $kardexModel->save($formData);
            }
        }
        echo json_encode("ok");
    }

    private function strToArray($str){
        $array = explode(',', $str);
        return $array;
    }
}
