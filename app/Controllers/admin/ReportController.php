<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ReportController extends BaseController{

    function __construct(){
    }

    public function index(){
        $areaModel = model('AreaModel');
        $financierModel = model('FinancierModel');

        $vulnerabilityModel = model('VulnerabilityModel');
        $supportModel = model('SuportModel');
        $companyModel = model('CompanyModel');


        $data['session'] = session()->get();
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();
        $data['financiers'] = $financierModel->findAll();
        $data['vulnerabilities'] = $vulnerabilityModel->where('status_id', 1)->findAll();
        $data['supports'] = $supportModel->where('status_id', 1)->findAll();
        $data['companies'] = $companyModel->findAll();

        return view('admin/report/index',$data);
    }

    public function getReport(){
    $db = \Config\Database::connect();
    
    $financier_id = $this->request->getPost('financier_id'); // Asegúrate que el nombre coincida con tu AJAX
    $dateInit     = $this->request->getPost('dateInit');
    $dateEnd      = $this->request->getPost('dateEnd');

    // Construcción de filtros
    $whereConditions = "b.beneficiary_deleted_at IS NULL";
    
    if (!empty($financier_id) && $financier_id != '0') {
        $whereConditions .= " AND b.financier_id = " . $db->escape($financier_id);
    }
    
    // Filtro por fecha de registro (Opcional: Si quieres ver quiénes entraron en esas fechas)
    if (!empty($dateInit) && !empty($dateEnd)) {
        $whereConditions .= " AND b.beneficiary_created_at BETWEEN " . $db->escape($dateInit) . " AND " . $db->escape($dateEnd . ' 23:59:59');
    }

    $query = "SELECT 
                b.beneficiary_id,
                b.beneficiary_names,
                b.beneficiary_lastnames,
                b.beneficiary_ci,
                b.beneficiary_ci_extension,
                b.beneficiary_gender,
                b.beneficiary_financier_year, -- Gestión (Año)
                
                -- Campo de dinero (Si es nulo o vacío, devolvemos 0 o texto)
                IFNULL(b.beneficiary_inst_money_amount, '0') as monto_recibido,
                
                -- Estado (Mapeo directo)
                CASE 
                    WHEN b.status_id = 1 THEN 'ACTIVO' 
                    ELSE 'INACTIVO' 
                END AS estado_texto,
                b.status_id,
                
                -- Datos del Financiador (JOIN)
                f.financier_project

            FROM new_beneficiary b
            LEFT JOIN financiers f ON f.financier_id = b.financier_id
            
            WHERE $whereConditions
            
            ORDER BY b.beneficiary_lastnames ASC";

    $reports = $db->query($query)->getResultArray();
    echo json_encode($reports);
}
}
