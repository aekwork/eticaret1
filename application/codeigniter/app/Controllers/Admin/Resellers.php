<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Resellers extends BaseController
{

    public function index(): string
    {
        $userModel = new UserModel();
        $this->data['title'] = 'Bayi Listesi';
        $this->data['users'] = $userModel->findAll();
        $this->data['price_profiles'] = $userModel->getPriceProfiles();
        return view('admin/resellers/index', $this->data);
    }

    public function create(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $userModel = new UserModel();
        $this->data['title'] = 'Bayi Ekle';
        $this->data['price_profiles'] = $userModel->getPriceProfiles();
        if ($this->request->getMethod() == 'post') {
            $data = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash(
                    $this->request->getPost('password'),
                    PASSWORD_DEFAULT
                ),
                'phone' => $this->request->getPost('phone'),
                'balance' => doubleval($this->request->getPost('balance')),
                'price_profile_id' => intval($this->request->getPost('price_profile_id')),
            ];

            foreach ($data as $val) {
                if (empty($val)) {
                    session()->setFlashdata('error', 'Lütfen tüm alanları doldurunuz.');
                    return redirect()->to('/admin/resellers/create');
                }
            }

            if (
                !is_double($data['balance']) &&
                !is_float($data['balance']) &&
                !is_int($data['balance']) &&
                !is_numeric($data['balance'])
            ) {
                $data['balance'] = 0;
            }

            if (
                $data['email'] == $data['password']
            ) {
                session()->setFlashdata('error', 'Email ve şifre aynı olamaz.');
                return redirect()->to('/admin/resellers/create');
            }

            $userModel->createUser($data);
            session()->setFlashdata('success', 'Bayi başarıyla eklendi.');
            return redirect()->to('/admin/resellers');
        }
        return view('admin/resellers/create', $this->data);
    }

    public function edit(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $userModel = new UserModel();
        $this->data['title'] = 'Bayi Düzenle';
        $this->data['user'] = $userModel->find($this->request->uri->getSegment(4));
        $this->data['price_profiles'] = $userModel->getPriceProfiles();
        if (
            $this->data['user'] == null
        ) {
            session()->setFlashdata('error', 'Bayi bulunamadı.');
            return redirect()->to('/admin/resellers');
        }
        if ($this->request->getMethod() == 'post') {
            $data = [
                'name' => $this->request->getPost('name'),
                'price_profile_id' => $this->request->getPost('price_profile_id'),
                'email' => $this->request->getPost('email'),
                'phone' => $this->request->getPost('phone'),
                'balance' => $this->request->getPost('balance'),
            ];
            if (
                $this->request->getPost('password') != null &&
                $this->request->getPost('password') != '' &&
                !empty($this->request->getPost('password'))
            ) {
                $data['password'] = password_hash(
                    $this->request->getPost('password'),
                    PASSWORD_DEFAULT
                );
                if (
                    $data['email'] == $data['password']
                ) {
                    session()->setFlashdata('error', 'Email ve şifre aynı olamaz.');
                    return redirect()->to('/admin/resellers/edit/' . $this->request->uri->getSegment(4));
                }

                if (
                    $this->request->getPost('password') != $this->request->getPost('password_confirmation')
                ) {
                    session()->setFlashdata('error', 'Şifreler uyuşmuyor.');
                    return redirect()->to('/admin/resellers/edit/' . $this->request->uri->getSegment(4));
                }
            }


            foreach ($data as $val) {
                if (empty($val)) {
                    session()->setFlashdata('error', 'Lütfen tüm alanları doldurunuz.');
                    return redirect()->to('/admin/resellers/edit/' . $this->request->uri->getSegment(4));
                }
            }

            if (
                !is_double($data['balance']) &&
                !is_float($data['balance']) &&
                !is_int($data['balance']) &&
                !is_numeric($data['balance'])
            ) {
                $data['balance'] = 0;
            }

            $userModel->updateUser($this->request->uri->getSegment(4), $data);
        }
        return view('admin/resellers/edit', $this->data);
    }

    public function view(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $userModel = new UserModel();
        $this->data['title'] = 'Bayi Detayı';
        $this->data['user'] = $userModel->find($this->request->uri->getSegment(4));
        if (
            $this->data['user'] == null
        ) {
            session()->setFlashdata('error', 'Bayi bulunamadı.');
            return redirect()->to('/admin/resellers');
        }
        return view('admin/resellers/view', $this->data);
    }

    public function list($profile_id)
    {
        $userModel = new UserModel();
        $this->data['title'] = 'Bayi Listesi';
        $this->data['users'] = $userModel->findByProfileId($profile_id);
        $this->data['price_profiles'] = $userModel->getPriceProfiles();
        return view('admin/resellers/index', $this->data);
    }

    public function delete(): \CodeIgniter\HTTP\RedirectResponse
    {
        $userModel = new UserModel();
        $userModel->delete($this->request->uri->getSegment(4));
        session()->setFlashdata('success', 'Bayi başarıyla silindi.');
        return redirect()->to('/admin/resellers');
    }
}
