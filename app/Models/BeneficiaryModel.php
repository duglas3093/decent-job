<?php

namespace App\Models;

use CodeIgniter\Model;

class BeneficiaryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'new_beneficiary'; // Nombre de tu nueva tabla
    protected $primaryKey       = 'beneficiary_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true; // Activado porque tenemos deleted_at en la BD
    protected $protectFields    = true;
    
    // AQUÍ ESTÁ LA MAGIA: Todos los campos que permitiremos guardar
    protected $allowedFields    = [
        // 1. Relación y Gestión
        'financier_id',
        'beneficiary_financier_year',
        'status_id',

        // 2. Datos Personales
        'beneficiary_names',
        'beneficiary_lastnames',
        'beneficiary_ci',
        'beneficiary_ci_extension',
        'beneficiary_gender',
        'beneficiary_birthdate',
        'beneficiary_cellphone',
        'beneficiary_ref_phone',
        'beneficiary_ref_name',
        'beneficiary_municipality',
        'beneficiary_other_municipality',

        // Mapa
        'beneficiary_latitude',
        'beneficiary_longitude',

        // 3. Emprendimiento
        'beneficiary_entrepreneurship_type',
        'beneficiary_sales_channel',
        'beneficiary_online_specify',
        'beneficiary_entrepreneurship_description',
        'beneficiary_sales_address',

        // 4. Conocimiento Técnico
        'beneficiary_start_motivation',
        'beneficiary_has_course',
        'beneficiary_course_name',
        'beneficiary_missing_skills',
        'beneficiary_business_age',
        'beneficiary_has_experience',
        'beneficiary_experience_source',
        'beneficiary_other_activities',
        'beneficiary_study_schedule',

        // Financiamiento Inicial
        'beneficiary_inst_bought',
        'beneficiary_inst_bought_name',
        'beneficiary_inst_bought_what',
        'beneficiary_inst_money',
        'beneficiary_inst_money_name',
        'beneficiary_inst_money_amount',
        'beneficiary_self_bought',
        'beneficiary_self_bought_what',
        'beneficiary_urgent_needs',
        'beneficiary_urgent_specify',

        // 5. Medio Ambiente
        'beneficiary_env_knowledge',
        'beneficiary_has_env_practices',
        'beneficiary_env_practices_desc',

        // 6. Costo, Ingreso y Capital
        'beneficiary_calc_cost',
        'beneficiary_calc_cost_detail',
        'beneficiary_accounting',
        'beneficiary_accounting_detail',
        
        // Trabajadores
        'beneficiary_has_workers',
        'beneficiary_women_count',
        'beneficiary_women_age',
        'beneficiary_men_count',
        'beneficiary_men_age',
        'beneficiary_remuneration',
        'beneficiary_monthly_income',

        // 7. Mercado
        'beneficiary_competitors_nearby',
        'beneficiary_sales_frequency',
        'beneficiary_value_proposition',
        'beneficiary_business_challenges',

        // 8. Legal
        'beneficiary_labor_rights_knowledge',
        'beneficiary_activity_laws_knowledge',

        // 9. Género
        'beneficiary_care_children',
        'beneficiary_care_children_relation',

        // 10. Expectativas
        'beneficiary_short_term_goal',
        'beneficiary_long_term_goals',
        'beneficiary_support_needed',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    
    // CONFIGURACIÓN IMPORTANTE: 
    // Como en la BD les pusimos el prefijo 'beneficiary_', debemos decírselo a CI4
    protected $createdField  = 'beneficiary_created_at';
    protected $updatedField  = 'beneficiary_updated_at';
    protected $deletedField  = 'beneficiary_deleted_at';

    // Validation
    // Te dejo unas reglas básicas sugeridas para el CI único
    protected $validationRules      = [
        'beneficiary_names'     => 'required|min_length[2]',
        'beneficiary_ci'        => 'required|numeric',
        // Esta regla evita duplicados de CI + Extension (necesita lógica extra o callback, 
        // pero por ahora validamos que sean requeridos)
        'beneficiary_ci_extension' => 'required',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}