<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['siteName', 'whatsapp_number', 'balance_page_html'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function getSetting($settingName)
    {
        $this->builder = $this->db->table($this->table);
        $this->builder->select($settingName);
        $query = $this->builder->get();
        $result = $query->getRowArray();
        return $result[$settingName];
    }

    public function saveSettings($settings)
    {
        // delete old settings
        $this->builder = $this->db->table($this->table);
        $this->builder->truncate();

        // insert new settings
        $this->builder->insert($settings);
    }
}
