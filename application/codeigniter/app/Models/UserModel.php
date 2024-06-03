<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'resellers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'email', 'phone', 'password', 'balance', 'price_profile_id'];

    // Dates
    protected $useTimestamps = false;
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

    public function findByProfileId($profile_id)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->where('price_profile_id', $profile_id);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getBalance($user_id)
    {
        $builder = $this->db->table($this->table);
        $builder->select('balance');
        $builder->where('id', $user_id);
        $query = $builder->get();
        $result = $query->getResultArray();
        if (count($result) > 0) {
            return $result[0]['balance'];
        }
        return 0;
    }

    public function getAllBalance()
    {
        $builder = $this->db->table($this->table);
        $builder->select('balance');
        $query = $builder->get();
        $result = $query->getResultArray();
        if (count($result) > 0) {
            $total_balance = doubleval(0);
            foreach ($result as $row) {
                $total_balance += doubleval($row['balance']);
            }
            return $total_balance;
        }
        return 0;
    }

    public function getTotalOrderCount($user_id)
    {
        $builder = $this->db->table('orders');
        $builder->select('COUNT(*) as total_order_count');
        $builder->where('user_id', $user_id);
        $query = $builder->get();
        $result = $query->getResultArray();
        if (count($result) > 0) {
            return $result[0]['total_order_count'];
        }
        return 0;
    }

    public function getAllTotalOrderCount( $start_date = null, $end_date = null )
    {
        $builder = $this->db->table('orders');
        $builder->select('COUNT(*) as total_order_count');
        if (!is_null($start_date)) {
            $builder->where('created_at >=', $start_date);
        }
        if (!is_null($end_date)) {
            $builder->where('created_at <=', $end_date);
        }
        $query = $builder->get();
        $result = $query->getResultArray();
        if (count($result) > 0) {
            $total_order_count = intval(0);
            foreach ($result as $row) {
                $total_order_count += intval($row['total_order_count']);
            }
            return $total_order_count;
        }
        return 0;
    }

    public function updateAllPriceProfiles($price_profile_id) {
        $builder = $this->db->table('resellers');
        $builder->set('price_profile_id', $price_profile_id);
        $builder->update();
    }

    public function getPriceProfiles()
    {
        $builder = $this->db->table('price_profiles');
        $builder->select('*');
        $query = $builder->get();
        $result = $query->getResultArray();
        return $result;
    }

    public function createUser($data) {
        $builder = $this->db->table('resellers');
        foreach ($data as $key => $value) {
            $builder->set($key, $value);
        }
        $builder->insert();
        return $this->db->insertID();
    }

    public function updateUser($user_id, $data) {
        $builder = $this->db->table('resellers');
        foreach ($data as $key => $value) {
            $builder->set($key, $value);
        }
        $builder->where('id', $user_id);
        $builder->update();
    }

    public function getUser($user_id) {
        $builder = $this->db->table('resellers');
        $builder->select('*');
        $builder->where('id', $user_id);
        $query = $builder->get();
        $result = $query->getResultArray();
        if (count($result) > 0) {
            return $result[0];
        }
        return ['name' => 'Silinmiş Kullanıcı'];
    }

    public function getAllTotalUserCount()
    {
        $builder = $this->db->table('resellers');
        $builder->select('COUNT(*) as total_user_count');
        $query = $builder->get();
        $result = $query->getResultArray();
        if (count($result) > 0) {
            return $result[0]['total_user_count'];
        }
        return 0;
    }
}
