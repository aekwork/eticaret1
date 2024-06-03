<?php

namespace App\Controllers\Reseller;

use App\Controllers\BaseController;
use App\Models\SettingsModel;
use App\Models\UserModel;

class Balance extends BaseController
{
    public function index()
    {
        $this->data['title'] = 'Bakiyem';
        $userModel = new UserModel();
        $settingsModel = new SettingsModel();
        $this->data['balance'] = number_format($userModel->getBalance($this->session->get('id')), 2);
        $this->data['balance_page_html'] = $settingsModel->getSetting('balance_page_html');
        return view('reseller/balance', $this->data);
    }
}
