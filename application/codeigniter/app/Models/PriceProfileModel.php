<?php

namespace App\Models;

use CodeIgniter\Database\MySQLi\Builder;
use CodeIgniter\Model;

class PriceProfileModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'price_profiles';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['profile_name'];

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

    public function getAll(): array
    {
        $this->builder = $this->db->table($this->table);
        $this->builder->select('*');
        $this->builder->orderBy('id', 'ASC');
        $query = $this->builder->get();
        $result = $query->getResultArray();
        foreach ($result as $key => $value) {
            $result[$key]['usage_count'] = $this->getUsageCount($value['id']);
        }
        return $result;
    }

    public function getUsageCount($id)
    {
        $this->builder = $this->db->table('resellers');
        $this->builder->select('COUNT(*) as usage_count');
        $this->builder->where('price_profile_id', $id);
        $query = $this->builder->get();
        $result = $query->getRowArray();
        return $result['usage_count'];
    }

    public function getProfile($id)
    {
        $this->builder = $this->db->table($this->table);
        $this->builder->select('*');
        $this->builder->where('id', $id);
        $query = $this->builder->get();
        return $query->getRowArray();
    }

    public function getPriceProfileCount()
    {
        $this->builder = $this->db->table($this->table);
        $this->builder->select('COUNT(*) as count');
        $query = $this->builder->get();
        $result = $query->getRowArray();
        return $result['count'];
    }

    public function getPrices($price_profile_id)
    {
        $this->builder = $this->db->table('prices');
        $this->builder->select('*, frame_type_id as frame_type');
        $this->builder->where('price_profile_id', $price_profile_id);
        $query = $this->builder->get();
        $result = $query->getResultArray();
        foreach ($result as $key => $value) {
            $this->builder = $this->db->table('product_frame_sizes');
            $this->builder->select('size as frame_size');
            $this->builder->where('id', $result[$key]['frame_size_id']);
            $query = $this->builder->get();
            $frame_size = $query->getRowArray();
            if (!is_null($frame_size)) {
                $result[$key]['frame_size'] = $frame_size['frame_size'];
            } else {
                $result[$key]['frame_size'] = '';
            }

            $this->builder = $this->db->table('product_frame_colors');
            $this->builder->select('color_name as frame_color_name');
            $this->builder->where('id', $result[$key]['frame_color_id']);
            $query = $this->builder->get();
            $frame_color = $query->getRowArray();
            if (!is_null($frame_color)) {
                $result[$key]['frame_color_name'] = $frame_color['frame_color_name'];
            } else {
                $result[$key]['frame_color_name'] = 'Renk Yok';
            }

            if ($result[$key]['frame_type'] == 1) {
                $result[$key]['frame_type'] = 'Çerçeveli';
            } else {
                $result[$key]['frame_type'] = 'Çerçevesiz';
            }
        }
        return $result;
    }

    public function getPrice($price_id) {
        $this->builder = $this->db->table('prices');
        $this->builder->select('*');
        $this->builder->where('id', $price_id);
        $query = $this->builder->get();
        $result = $query->getRowArray();
        return $result;
    }

    public function deletePrice($price_id) {
        $this->builder = $this->db->table('prices');
        $this->builder->where('id', $price_id);
        $this->builder->delete();
    }

    public function addPrice($data) {
        $this->builder = $this->db->table('prices');
        foreach ($data as $key => $value) {
            $this->builder->set($key, $value);
        }
        $this->builder->insert();
    }

    public function updatePrice($id, $data) {
        $this->builder = $this->db->table('prices');
        foreach ($data as $key => $value) {
            $this->builder->set($key, $value);
        }
        $this->builder->where('id', $id);
        $this->builder->update();
    }
}
