<?php

namespace App\Models;

use CodeIgniter\Model;

class BeneficiaryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'beneficiaries';
    protected $primaryKey       = 'beneficiary_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'beneficiary_name',
        'beneficiary_lastname',
        'beneficiary_ci',
        'beneficiary_complement',
        'beneficiary_email',
        'beneficiary_celphone',
        'beneficiary_password',
        'beneficiary_datebirth',
        'beneficiary_direction',
        'city_id',
        'schedule_id',
        'sm_id',
        'status_id',
        'beneficiary_workweek',
        'beneficiary_entrepreneurship',
        'beneficiary_skills',
        'beneficiary_business',
        'beneficiary_job',
        'beneficiary_experience',
        'beneficiary_workarea',
        'beneficiary_notworkarea',
        'beneficiary_grade'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
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
