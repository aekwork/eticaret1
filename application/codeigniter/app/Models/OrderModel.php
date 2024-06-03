<?php

namespace App\Models;

use CodeIgniter\Model;
use function App\Helpers\getOrderStatus;
use function App\Helpers\getOrderDefaultStatus;
use function App\Helpers\getUserPriceProfile;

helper('Order_helper');


class OrderModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
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

    public function calculatePriceTotal(
        $product_frame_size,
        $product_frame_type,
        $product_frame_color,
        $recipient_country,
        $gift_package,
        $user_id
    )
    {
        $builder = $this->db->table('prices');
        $builder->select('price');
        $builder->where('price_profile_id', getUserPriceProfile($user_id));
        $builder->where('frame_size_id', $product_frame_size);
        $builder->where('frame_type_id', $product_frame_type);
        $builder->where('frame_color_id', $product_frame_color);
        $query = $builder->get();
        $result = $query->getResultArray();
        if (count($result) > 0) {
            $product_price = $result[0]['price'];
        } else {
            $product_price = 0;
        }

        $builder = $this->db->table('country_pricing_regions');
        $builder->select('region_id');
        $builder->where('id', $recipient_country);
        $query = $builder->get();
        $result = $query->getResultArray();
        if (count($result) > 0) {
            $recipient_region = $result[0]['region_id'];
        } else {
            $recipient_region = 0;
        }

        $builder = $this->db->table('regions');
        $builder->select('price');
        $builder->where('id', $recipient_region);
        $query = $builder->get();
        $result = $query->getResultArray();
        if (count($result) > 0) {
            $recipient_region_price = $result[0]['price'];
        } else {
            $recipient_region_price = 0;
        }

        if ($gift_package == 1) {
            $gift_package_price = 5;
        } else {
            $gift_package_price = 0;
        }

        return $product_price + $recipient_region_price + $gift_package_price;
    }

    public function getMyOrders()
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_id, product_code, product_thumbnail, created_at, total_paid, product_frame_color, product_frame_size, product_frame_type, recipient_country, status');
        $builder->where('user_id', session()->get('id'));
        $query = $builder->get();
        $result = $query->getResultArray();
        foreach ($result as $key => $val) {
            $builder = $this->db->table('product_frame_sizes');
            $builder->select('size');
            $builder->where('id', $val['product_frame_size']);
            $query = $builder->get();
            $result2 = $query->getResultArray();
            if (count($result2) > 0) {
                $result[$key]['product_frame_size'] = $result2[0]['size'];
            } else {
                $result[$key]['product_frame_size'] = '';
            }

            $builder = $this->db->table('product_frame_colors');
            $builder->select('color_name');
            $builder->where('id', $val['product_frame_color']);
            $query = $builder->get();
            $result2 = $query->getResultArray();
            if (count($result2) > 0) {
                $result[$key]['product_frame_color'] = $result2[0]['color_name'];
            } else {
                $result[$key]['product_frame_color'] = 'X';
            }

            if ($val['product_frame_type'] == 1) {
                $result[$key]['product_frame_type'] = 'Var';
            } else {
                $result[$key]['product_frame_type'] = 'X';
            }

            $builder = $this->db->table('country_pricing_regions');
            $builder->select('country_name');
            $builder->where('id', $val['recipient_country']);
            $query = $builder->get();
            $result2 = $query->getResultArray();
            if (count($result2) > 0) {
                $result[$key]['recipient_country'] = $result2[0]['country_name'];
            } else {
                $result[$key]['recipient_country'] = '';
            }
        }
        return $result;
    }

    public function getOrders($status_code = null, $user_id = null, $start_date = null, $end_date = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_id, product_code, user_id, product_image, product_thumbnail, created_at, total_paid, product_frame_size, product_frame_color, product_frame_type, recipient_country, status, gift_package, gift_message');
        if ($status_code != null) {
            $builder->where('status', $status_code);
        }
        if ($start_date != null) {
            $builder->where('created_at >=', $start_date);
        }
        if ($end_date != null) {
            $builder->where('created_at <=', $end_date);
        }
        if ($user_id != null) {
            $builder->where('user_id', $user_id);
        }
        $query = $builder->get();
        $result = $query->getResultArray();
        if (
            count($result) > 0
        ) {
            foreach ($result as $key => $val) {
                $builder = $this->db->table('product_frame_sizes');
                $builder->select('size');
                $builder->where('id', $val['product_frame_size']);
                $query = $builder->get();
                $result2 = $query->getResultArray();
                if (count($result2) > 0) {
                    $result[$key]['product_frame_size'] = $result2[0]['size'];
                } else {
                    $result[$key]['product_frame_size'] = '';
                }

                $builder = $this->db->table('product_frame_colors');
                $builder->select('color_name');
                $builder->where('id', $val['product_frame_color']);
                $query = $builder->get();
                $result2 = $query->getResultArray();
                if (count($result2) > 0) {
                    $result[$key]['product_frame_color'] = $result2[0]['color_name'];
                } else {
                    $result[$key]['product_frame_color'] = 'X';
                }

                if ($val['product_frame_type'] == 1) {
                    $result[$key]['product_frame_type'] = 'Var';
                } else {
                    $result[$key]['product_frame_type'] = 'X';
                }

                $builder = $this->db->table('country_pricing_regions');
                $builder->select('country_name');
                $builder->where('id', $val['recipient_country']);
                $query = $builder->get();
                $result2 = $query->getResultArray();
                if (count($result2) > 0) {
                    $result[$key]['recipient_country'] = $result2[0]['country_name'];
                } else {
                    $result[$key]['recipient_country'] = '';
                }
            }
        }
        return $result;
    }

    public function createNewOrder(
        $product_code,
        $product_image,
        $product_thumbnail,
        $product_frame_size,
        $product_frame_type,
        $product_frame_color,
        $recipient_name,
        $recipient_email,
        $recipient_phone = null,
        $recipient_address,
        $recipient_iossvat = null,
        $recipient_country,
        $gift_package,
        $gift_message,
        $total_paid,
        $user_id
    )
    {
        // balance actions

        $builder = $this->db->table('resellers');
        $builder->select('balance');
        $builder->where('id', $user_id);
        $query = $builder->get();
        $result = $query->getResultArray();
        if (count($result) > 0) {
            $balance = $result[0]['balance'];
        } else {
            $balance = 0;
        }
        /*
        if (doubleval($balance) < doubleval($total_paid)) {
            return false;
        }
        */

        $data = [
            'product_code' => $product_code,
            'product_image' => $product_image,
            'product_thumbnail' => $product_thumbnail,
            'product_frame_size' => $product_frame_size,
            'product_frame_type' => $product_frame_type,
            'product_frame_color' => $product_frame_color,
            'recipient_name' => $recipient_name,
            'recipient_email' => $recipient_email,
            'recipient_phone' => $recipient_phone,
            'recipient_address' => $recipient_address,
            'recipient_country' => $recipient_country,
            'recipient_iossvat' => $recipient_iossvat,
            'gift_package' => $gift_package,
            'gift_message' => $gift_message,
            'total_paid' => $total_paid,
            'user_id' => $user_id,
            'status' => getOrderDefaultStatus()
        ];

        $this->db->table('orders')->insert($data);
        $insert_id = $this->db->insertID();
        if ($this->db->affectedRows() > 0) {
            $builder = $this->db->table('resellers');
            $builder->set('balance', 'balance - ' . $total_paid, FALSE);
            $builder->where('id', $user_id);
            $builder->update();
        }
        return $insert_id;
    }

    public function updateOrder(
        $order_id,
        $product_code,
        $product_image,
        $product_thumbnail,
        $product_frame_size,
        $product_frame_type,
        $product_frame_color,
        $recipient_name,
        $recipient_email,
        $recipient_phone = null,
        $recipient_address,
        $recipient_iossvat = null,
        $recipient_country,
        $gift_package,
        $total_paid,
        $status,
        $order_note,
        $user_id
    )
    {
        $data = [
            'product_code' => $product_code,
            'product_image' => $product_image,
            'product_thumbnail' => $product_thumbnail,
            'product_frame_size' => $product_frame_size,
            'product_frame_type' => $product_frame_type,
            'product_frame_color' => $product_frame_color,
            'recipient_name' => $recipient_name,
            'recipient_email' => $recipient_email,
            'recipient_phone' => $recipient_phone,
            'recipient_address' => $recipient_address,
            'recipient_country' => $recipient_country,
            'recipient_iossvat' => $recipient_iossvat,
            'gift_package' => $gift_package,
            'total_paid' => $total_paid,
            'status' => $status,
            'note' => $order_note,
            'user_id' => $user_id,
        ];

        $builder = $this->db->table('orders');
        $builder->where('order_id', $order_id);
        $builder->where('user_id', $user_id);
        $builder->update($data);
        return $this->db->affectedRows();
    }

    public function getOrderDetail($order_id, $session_use = true)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->where('order_id', $order_id);
        if ($session_use) $builder->where('user_id', session()->get('id'));
        $query = $builder->get();
        $result = $query->getResultArray();
        if (count($result) > 0) {
            $result = $result[0];
            $builder = $this->db->table('product_frame_sizes');
            $builder->select('size');
            $builder->where('id', $result['product_frame_size']);
            $query = $builder->get();
            $result2 = $query->getResultArray();
            if (count($result2) > 0) {
                $result['product_frame_size'] = $result2[0]['size'];
            } else {
                $result['product_frame_size'] = '';
            }

            if (
                $result['product_frame_type'] == 1
            ) {
                $result['product_frame_type'] = 'Var';
            } else {
                $result['product_frame_type'] = 'Yok';
            }
            $result['status'] = getOrderStatus($result['status']);
            $builder = $this->db->table('product_frame_colors');
            $builder->select('color_name');
            $builder->where('id', $result['product_frame_color']);
            $query = $builder->get();
            $result2 = $query->getResultArray();
            if (count($result2) > 0) {
                $result['product_frame_color'] = $result2[0]['color_name'];
            } else {
                $result['product_frame_color'] = 'Çerçeve Yok';
            }

            $builder = $this->db->table('country_pricing_regions');
            $builder->select('country_name');
            $builder->where('id', $result['recipient_country']);
            $query = $builder->get();
            $result2 = $query->getResultArray();
            if (count($result2) > 0) {
                $result['recipient_country'] = $result2[0]['country_name'];
            } else {
                $result['recipient_country'] = '';
            }

            if ($result['gift_package'] == 1) {
                $result['gift_package'] = 'Var';
            } else {
                $result['gift_package'] = 'Yok';
            }

            return $result;
        } else {
            return [];
        }
    }
}