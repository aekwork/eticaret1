<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PriceProfileModel;
use App\Models\UserModel;

class PriceProfiles extends BaseController
{
    private PriceProfileModel $priceProfileModel;

    public function index()
    {
        //
    }

    public function add()
    {
        $this->data['title'] = 'Fiyat Profili Ekle';

        if (
            $this->request->getMethod() == 'post'
        ) {
            $data = [
                'profile_name' => $this->request->getPost('profile_name')
            ];

            foreach ($data as $val) {
                if (empty($val)) {
                    session()->setFlashdata('error', 'Lütfen tüm alanları doldurunuz.');
                    return redirect()->to('/admin/price-profiles/add');
                }
            }

            $this->priceProfileModel = new PriceProfileModel();
            $this->priceProfileModel->insert($data);
            session()->setFlashdata('success', 'Fiyat profili başarıyla eklendi.');
            return redirect()->to('/admin/price-management');
        }

        return view('admin/price_profiles/add', $this->data);
    }

    public function edit($id)
    {
        $this->data['title'] = 'Fiyat Profili Düzenle';

        $this->priceProfileModel = new PriceProfileModel();
        $priceProfile = $this->priceProfileModel->find($id);
        if (!$priceProfile) {
            session()->setFlashdata('error', 'Fiyat profili bulunamadı.');
            return redirect()->to('/admin/price-management');
        }

        if (
            $this->request->getMethod() == 'post'
        ) {
            $data = [
                'profile_name' => $this->request->getPost('profile_name')
            ];

            foreach ($data as $val) {
                if (empty($val)) {
                    session()->setFlashdata('error', 'Lütfen tüm alanları doldurunuz.');
                    return redirect()->to('/admin/price-profiles/edit/' . $id);
                }
            }

            $this->priceProfileModel->update($id, $data);
            session()->setFlashdata('success', 'Fiyat profili başarıyla düzenlendi.');
            return redirect()->to('/admin/price-management');
        }

        $this->data['priceProfile'] = $priceProfile;
        return view('admin/price_profiles/edit', $this->data);
    }

    public function delete($id)
    {
        $priceProfileModel = new PriceProfileModel();
        $priceProfileCount = $priceProfileModel->getPriceProfileCount();
        if ($priceProfileCount == 1) {
            session()->setFlashdata('error', 'En az bir fiyat profili olmalıdır.');
            return redirect()->to('/admin/price-management');
        }
        $priceProfileModel->delete($id);
        session()->setFlashdata('success', 'Fiyat profili başarıyla silindi.');
        $priceProfileCount = $priceProfileModel->getPriceProfileCount();
        if ($priceProfileCount == 1) {
            $userModel = new UserModel();
            $userModel->updateAllPriceProfiles($id);
        }
        return redirect()->to('/admin/price-management');
    }

    public function view($id) {
        return view('admin/price_profiles/view', $this->data);
    }
}
