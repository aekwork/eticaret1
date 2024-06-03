<?php

namespace App\Models;

use CodeIgniter\Model;

class RegionModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'regions';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['name', 'price'];

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

    public function getRegions(): array
    {
        $this->builder = $this->db->table('regions');
        $this->builder->select('id, name');
        $query = $this->builder->get();
        $result = $query->getResultArray();
        foreach ($result as $key => $value) {
            $this->builder = $this->db->table('country_pricing_regions');
            $this->builder->select('COUNT(*) AS count');
            $this->builder->where('region_id', $value['id']);
            $query = $this->builder->get();
            $result[$key]['country_count'] = $query->getRow()->count;
        }
        return $result;
    }

    public function getRegion(int $regionId): array
    {
        $this->builder = $this->db->table('regions');
        $this->builder->select('id, name, price');
        $this->builder->where('id', $regionId);
        $query = $this->builder->get();
        return $query->getRowArray();
    }

    public function getCountries(): array {
        $this->builder = $this->db->table('country_pricing_regions');
        $this->builder->select('id, country_name, region_id');
        $query = $this->builder->get();
        $result = $query->getResultArray();
        foreach ($result as $key => $val) {
            $this->builder = $this->db->table('regions');
            $this->builder->select('name');
            $this->builder->where('id', $val['region_id']);
            $query = $this->builder->get();
            $result[$key]['region_name'] = $query->getRow()->name;
        }
        return $result;
    }

    public function getCountry(int $countryId): array {
        $this->builder = $this->db->table('country_pricing_regions');
        $this->builder->select('*');
        $this->builder->where('id', $countryId);
        $query = $this->builder->get();
        return $query->getRowArray();
    }

    public function addCountry(array $data): bool {
        $this->builder = $this->db->table('country_pricing_regions');
        $this->builder->insert($data);
        return true;
    }

    public function editCountry(array $data, int $countryId): bool {
        $this->builder = $this->db->table('country_pricing_regions');
        $this->builder->where('id', $countryId);
        $this->builder->update($data);
        return true;
    }

    public function deleteCountry(int $countryId): bool {
        $this->builder = $this->db->table('country_pricing_regions');
        $this->builder->where('id', $countryId);
        $this->builder->delete();
        return true;
    }
}
