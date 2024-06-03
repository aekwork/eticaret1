<?php

namespace App\Controllers\Reseller;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    public function change_password()
    {
        if ($this->request->getMethod() == 'post') {
            $password = $this->request->getPost('password');
            $password_confirmation = $this->request->getPost('password_confirmation');
            $rules = [
                'password' => 'required|min_length[6]|max_length[255]',
                'password_confirmation' => 'required|min_length[6]|max_length[255]',
            ];
            if ($password != $password_confirmation) {
                $this->session->setFlashdata('error', 'Şifreler uyuşmuyor.');
                return redirect()->to('/change-password');
            }

            if (!$this->validate($rules)) {
                $this->data['validation'] = $this->validator;
                $this->data['title'] = 'Şifre Değiştir';
                return view('/change-password', $this->data);
            }

            $userModel = new UserModel();
            $userModel->update($this->session->get('id'), ['password' => password_hash($password, PASSWORD_DEFAULT)]);
            $this->session->setFlashdata('success', 'Şifreniz başarıyla değiştirildi.');
            return redirect()->to('/change-password');
        }
        $this->data['title'] = 'Şifre Değiştir';
        return view('reseller/change-password', $this->data);
    }
}
