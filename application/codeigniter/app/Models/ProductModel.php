<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;
use function App\Helpers\getUserPriceProfile;

helper('Order_helper');

class ProductModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'products';
    protected $primaryKey = 'product_id';
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
    private \CodeIgniter\HTTP\IncomingRequest|\CodeIgniter\HTTP\CLIRequest $request;

    public function getProductFrameSizes($user_id = null): array
    {
        if ($user_id == null) {
            $user_id = session()->get('id');
        }
        $this->builder = $this->db->table('prices');
        $this->builder->select('frame_size_id');
        $this->builder->groupBy('frame_size_id');
        $this->builder->where('price_profile_id', getUserPriceProfile($user_id));
        $query = $this->builder->get();
        $result = $query->getResultArray();

        if (count($result) === 0) {
            return [];
        }

        $this->builder = $this->db->table('product_frame_sizes');
        $this->builder->select('*');
        foreach ($result as $value) {
            $this->builder->orWhere('id', $value['frame_size_id']);
        }
        $query = $this->builder->get();
        return $query->getResultArray();
    }

    public function getProductFrameTypes($frame_size_id, $user_id = null): array
    {
        $this->request = Services::request();
        if ($user_id == null) {
            $user_id = session()->get('id');
        }
        $this->builder = $this->db->table('prices');
        $this->builder->select('frame_type_id');
        $this->builder->where('frame_size_id', $frame_size_id);
        $this->builder->where('price_profile_id', getUserPriceProfile($user_id));
        $this->builder->groupBy('frame_type_id');
        $this->builder->orderBy('frame_type_id', 'ASC');
        $query = $this->builder->get();
        $result = $query->getResultArray();
        return $result;
    }

    public function getProductFrameColors($frame_size_id, $frame_type_id, $user_id = null): array
    {
        $this->request = Services::request();
        if ($user_id == null) {
            $user_id = session()->get('id');
        }
        $this->builder = $this->db->table('prices');
        $this->builder->select('frame_color_id');
        $this->builder->groupBy('frame_color_id');
        $this->builder->where('frame_size_id', $frame_size_id);
        $this->builder->where('frame_type_id', $frame_type_id);
        $this->builder->where('price_profile_id', getUserPriceProfile($user_id));
        $query = $this->builder->get();
        $result = $query->getResultArray();

        if (count($result) === 0) {
            return [];
        }

        $this->builder = $this->db->table('product_frame_colors');
        $this->builder->select('*');
        foreach ($result as $value) {
            $this->builder->orWhere('id', $value['frame_color_id']);
        }
        $query = $this->builder->get();
        return $query->getResultArray();
    }

    public function getFrameSizes(): array
    {
        $this->builder = $this->db->table('product_frame_sizes');
        $this->builder->select('*');
        $query = $this->builder->get();
        return $query->getResultArray();
    }

    public function insertFrameSize($data): bool
    {
        $this->builder = $this->db->table('product_frame_sizes');
        $this->builder->insert($data);
        return true;
    }

    public function getFrameSize($id): array
    {
        $this->builder = $this->db->table('product_frame_sizes');
        $this->builder->select('*');
        $this->builder->where('id', $id);
        $query = $this->builder->get();
        return $query->getRowArray();
    }

    public function updateFrameSize($id, $data): bool
    {
        $this->builder = $this->db->table('product_frame_sizes');
        $this->builder->where('id', $id);
        $this->builder->update($data);
        return true;
    }

    public function deleteFrameSize($id): bool
    {
        $this->builder = $this->db->table('product_frame_sizes');
        $this->builder->where('id', $id);
        $this->builder->delete();
        return true;
    }

    public function getColorNames(): array
    {
        $this->builder = $this->db->table('product_frame_colors');
        $this->builder->select('*');
        $query = $this->builder->get();
        return $query->getResultArray();
    }

    public function insertColorName($data): bool
    {
        $this->builder = $this->db->table('product_frame_colors');
        $this->builder->insert($data);
        return true;
    }

    public function getColorName($id): array
    {
        $this->builder = $this->db->table('product_frame_colors');
        $this->builder->select('*');
        $this->builder->where('id', $id);
        $query = $this->builder->get();
        return $query->getRowArray();
    }

    public function updateColorName($id, $data): bool
    {
        $this->builder = $this->db->table('product_frame_colors');
        $this->builder->where('id', $id);
        $this->builder->update($data);
        return true;
    }

    public function deleteColorName($id): bool
    {
        $this->builder = $this->db->table('product_frame_colors');
        $this->builder->where('id', $id);
        $this->builder->delete();
        return true;
    }

    public function getAllProductFrameSizes(): array
    {
        $this->builder = $this->db->table('product_frame_sizes');
        $this->builder->select('*');
        $query = $this->builder->get();
        return $query->getResultArray();
    }

    public function getAllProductFrameColors(): array
    {
        $this->builder = $this->db->table('product_frame_colors');
        $this->builder->select('*');
        $query = $this->builder->get();
        return $query->getResultArray();
    }

    public function getAllProductFrameTypes(): array
    {
        return [
            [
                'frame_type_id' => 1
            ],
            [
                'frame_type_id' => 2
            ]
        ];
    }
}
