<?php

namespace App\Models;

use CodeIgniter\Model;

class CountryPricingRegionModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'product_region_impacts';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [];

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

    public function getRecipientCountries() {
        $builder = $this->db->table('country_pricing_regions');
        $builder->select('*');
        $query = $builder->get();
        $result = $query->getResultArray();
        $country_short_codes = [];
        foreach ($result as $row) {
            $country_short_codes[] = [
                'id' => $row['id'],
                'country_name' => $row['country_name'],
            ];
        }
        return $country_short_codes;
    }

    public function getRegions() {
        $builder = $this->db->table('regions');
        $builder->select('*');
        $query = $builder->get();
        $result = $query->getResultArray();
        return $result;
    }
}
