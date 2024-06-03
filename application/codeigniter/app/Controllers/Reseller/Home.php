<?php

namespace App\Controllers\Reseller;
use App\Models\UserModel;
use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $this->data['title'] = 'Ana Sayfa';
        $userModel = new UserModel();
        $this->data['balance'] = number_format($userModel->getBalance($this->session->get('id')), 2);
        $this->data['total_order_count'] = $userModel->getTotalOrderCount($this->session->get('id'));
        return view('reseller/dashboard', $this->data);
    }
}
