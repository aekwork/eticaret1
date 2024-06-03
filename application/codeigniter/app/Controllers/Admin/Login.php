<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use function App\Helpers\getAdminId;
use function App\Helpers\isAdminValid;

helper('Auth_helper');

class Login extends BaseController
{
    public function login()
    {
        $this->data['user_login'] = false;
        if ($this->session->get('isLoggedInAdmin')) {
            return redirect()->to('/admin');
        }
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[6]|max_length[255]'
            ];
            $errors = [
                'password' => [
                    'email' => 'E-posta veya şifre yanlış.',
                ],
            ];

            if ($this->validate($rules, $errors)) {
                if (isAdminValid($this->request->getVar('email'), $this->request->getVar('password'))) {
                    $sessionData = [
                        'id' => getAdminId($this->request->getVar('email')),
                        'isLoggedInAdmin' => true,
                    ];
                    $this->session->set($sessionData);
                    return redirect()->to('/admin');
                } else {
                    $this->session->setFlashdata('error', 'E-posta veya şifre yanlış.');
                }
            } else {
                $this->session->setFlashdata('error', $this->validator->listErrors());
            }
        }
        echo view('login', $this->data);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/admin/login');
    }
}
