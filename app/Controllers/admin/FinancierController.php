<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Financier;
use CodeIgniter\Exceptions\PageNotFoundException;

class FinancierController extends BaseController
{
    private $session;
    private const PAGINATION = 1000;
    private const STATUS = 4;

    public function __construct(){
        $session = session()->get();
    }

    public function index(){
        
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $financierModel = model('FinancierModel');
        $data['session'] = session()->get();
        $data['financiers'] = $financierModel
                            ->join('status s','s.status_id = financiers.status_id','LEFT')
                            ->select('financiers.*, s.status_name')
                            ->paginate(self::PAGINATION);
        return view('admin/financier/index',$data);
    }
    
    public function add(){
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $statusModel = model('StatusModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        
        return view('admin/financier/add',$data);
    }

    public function edit(int $financier_id){
        $financierModel = model('FinancierModel');
        if(!$data['financier'] = $financierModel->where('financier_id', $financier_id)->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $statusModel = model('StatusModel');
        $data['status'] = $statusModel->where('status_category',1)->findAll();
        return view('admin/financier/edit',$data);
    }

    public function store(){
        $validation = service('validation');
        $validation->setRules([
            'financier_project'    => ['label' => 'name','rules' => 'required']
        ]);

        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }

        $form = $this->request->getPost();
        $register = [
            'status_id'     => 1,//1 active
        ];
        
        $suportData = array_merge($form,$register);
        $suport = new Financier($suportData);
        $financierModel = model('FinancierModel');

        $financierModel->save($suport);
        return redirect()->route('admin/financiers')->with('msg',[
            'type' => 'green',
            'body' => 'Nuevo financiador registrado exitosamente!'
        ]);
    }

    public function update(){
        $validation = service('validation');
        $validation->setRules([
            'financier_project'   => ['label' => 'descripción' ,'rules' => 'required'],
        ]);
        
        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }
        
        $model = model('FinancierModel');
        if(!$model->where('financier_id', (int)trim($this->request->getVar('financier_id')))->first()){
            throw PageNotFoundException::forPageNotFound();
        }
        $model->save([
            'financier_id'              => trim($this->request->getVar('financier_id')),
            'financier_project'         => trim($this->request->getVar('financier_project')),
            'financier_description'     => trim($this->request->getVar('financier_description')),
            'status_id'                 => (int)trim($this->request->getVar('status_id')),
        ]);
        return redirect()->route('admin/financiers')->with('msg',[
            'type'=>'green',
            'body'=> 'La vulnerabilidad se actualizo exitosamente.'
        ]);   
    }

    public function vulnerabilyBeneficiary() {
        $beneficairy_id = $this->request->getPost('beneficiary');
        $model = model('BeneficiaryVulnerabilitiesModel');
        $vulnerabilities = $model->join('vulnerabilities v','beneficiary_vulnerabilities.vulnerability_id = v.vulnerability_id','LEFT')
                                ->select('beneficiary_vulnerabilities.bevu_observation,v.vulnerability_name,beneficiary_vulnerabilities.bevu_id')
                                ->where('beneficiary_vulnerabilities.beneficiary_id', $beneficairy_id)->findAll();
        echo json_encode($vulnerabilities);
    }

    public function storeVulnerabilyBeneficiary(){
        $beneficairy_id = $this->request->getPost('beneficiary');
        $bevu_id = $this->request->getPost('bevu');
        $vulnerability_id = $this->request->getPost('vulnerability');
        $observation = $this->request->getPost('observation');

        $vulnerabilityModel = model('BeneficiaryVulnerabilitiesModel');

        if ($bevu_id != "") {
            // $vulnerabilityModel->save($vulnerability);
            $vulnerabilityModel->save([
                    'bevu_id'               => $bevu_id,
                    'beneficiary_id'        => $beneficairy_id,
                    'bevu_observation'      => $observation,
                    'vulnerability_id'      => $vulnerability_id
                ]);
        }else{
            $data = [
                'beneficiary_id'        => $beneficairy_id,
                'bevu_observation'      => $observation,
                'vulnerability_id'      => $vulnerability_id
            ];
            
            $vulnerability = new BeneficiaryVulnerabilities($data);
            $vulnerabilityModel->save($vulnerability);
        }

        echo json_encode("ok");
    }
    
    public function editVulnerabilyBeneficiary(){
        $bevu_id = $this->request->getPost('bevu_id');

        $model = model('BeneficiaryVulnerabilitiesModel');
        $data = $model->where('beneficiary_vulnerabilities.bevu_id', $bevu_id)->first();
        // $vulnerabilityModel->save($vulnerability);
        echo json_encode($data);
    }

    public function deleteVulnerability(){
        $bevu_id = $this->request->getPost('bevu_id');

        $model = model('BeneficiaryVulnerabilitiesModel');
        $model->where('bevu_id', $bevu_id)->delete();
        echo "ok";
    }
}
