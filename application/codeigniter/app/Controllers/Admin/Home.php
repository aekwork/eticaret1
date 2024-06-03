<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Home extends BaseController
{
    public function index()
    {
        $this->data['title'] = 'Ana Sayfa';
        $userModel = new UserModel();
        $this->data['balance'] = number_format($userModel->getAllBalance(), 2);
        $this->data['total_user_count'] = $userModel->getAllTotalUserCount();
        $start_date = $this->request->getVar('start_date');
        $end_date = $this->request->getVar('end_date');
        if (preg_match('/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{4}$/', $start_date)) {
            $start_date = explode('.', $start_date);
            $start_date = $start_date[2] . '-' . (strlen($start_date[1]) == 1 ? '0' . $start_date[1] : $start_date[1]) . '-' . $start_date[0];
        }
        if (preg_match('/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{4}$/', $end_date)) {
            $end_date = explode('.', $end_date);
            $end_date = $end_date[2] . '-' . (strlen($end_date[1]) == 1 ? '0' . $end_date[1] : $end_date[1]) . '-' . $end_date[0];
        }
        if (!empty($start_date) && !empty($end_date)){
            $this->data['total_order_count'] = $userModel->getAllTotalOrderCount($start_date, $end_date);
        } elseif (!empty($start_date) && empty($end_date)){
            $this->data['total_order_count'] = $userModel->getAllTotalOrderCount($start_date);
        } elseif (empty($start_date) && !empty($end_date)){
            $this->data['total_order_count'] = $userModel->getAllTotalOrderCount(null, $end_date);
        } elseif (empty($start_date) && empty($end_date)){
            $this->data['total_order_count'] = $userModel->getAllTotalOrderCount();
        }
        return view('admin/dashboard', $this->data);
    }
}
