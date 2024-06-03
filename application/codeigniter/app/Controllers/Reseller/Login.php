<?php

namespace App\Controllers\Reseller;

use App\Controllers\BaseController;
use App\Models\SettingsModel;
use function App\Helpers\isUserValid;
use function App\Helpers\getUserId;

helper('Auth_helper');

class Login extends BaseController
{
    /**
     * This function is used to validate the user and login the user.
     * @return \CodeIgniter\HTTP\RedirectResponse|void
     */
    public function index()
    {
        $settingsModel = new SettingsModel();
        $this->data['whatsapp_number'] = $settingsModel->getSetting('whatsapp_number');
        $this->data['user_login'] = true;
        if ($this->session->get('isLoggedInUser')) {
            return redirect()->to('/dashboard');
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
                if (isUserValid($this->request->getVar('email'), $this->request->getVar('password'))) {
                    $sessionData = [
                        'id' => getUserId($this->request->getVar('email')),
                        'isLoggedInUser' => true,
                    ];
                    $this->session->set($sessionData);
                    return redirect()->to('/dashboard');
                } else {
                    $this->session->setFlashdata('error', 'E-posta veya şifre yanlış.');
                }
            } else {
                $this->session->setFlashdata('error', $this->validator->listErrors());
            }
        }
        echo view('login', $this->data);
    }

    /**
     * Used to end the session and logout the user.
     * @return \CodeIgniter\HTTP\RedirectResponse Redirects the user to /login page after ending the session.
     */
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }

}