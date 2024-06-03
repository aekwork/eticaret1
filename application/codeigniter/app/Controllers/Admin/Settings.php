<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SettingsModel;

class Settings extends BaseController
{

    public function index(): string
    {
        $settingsModel = new SettingsModel();
        $this->data['title'] = 'Site Ayarları';

        if ($this->request->getMethod() === 'post') {
            $settingsModel->saveSettings($this->request->getPost());
            $this->data['success'] = 'Ayarlar başarıyla güncellendi.';
        }
        $this->data['settings'] = $settingsModel->findAll()[0];

        return view('admin/settings', $this->data);
    }
}
