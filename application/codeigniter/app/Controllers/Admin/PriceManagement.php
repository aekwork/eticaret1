<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PriceProfileModel;

class PriceManagement extends BaseController
{
    private PriceProfileModel $priceProfilModel;
    private OrderModel $orderModel;

    public function index()
    {
        $this->priceProfilModel = new PriceProfileModel();

        $this->data['title'] = 'Fiyat Yönetimi';
        $this->data['price_profiles'] = $this->priceProfilModel->getAll();
        return view('admin/price_management/index', $this->data);
    }

    public function view($price_profile_id)
    {
        $this->data['title'] = 'Fiyat Yönetimi';
        $this->priceProfilModel = new PriceProfileModel();
        $profile = $this->priceProfilModel->getProfile($price_profile_id);
        if ($profile == null) {
            session()->setFlashdata('error', 'Ürün profili bulunamadı.');
            return redirect()->to('/admin/price-management');
        }
        $this->data['profile'] = $profile;
        $this->data['prices'] = $this->priceProfilModel->getPrices($price_profile_id);
        $this->data['price_profile_id'] = $price_profile_id;
        return view('admin/price_management/view', $this->data);
    }

    public function add($price_profile_id)
    {
        $this->data['title'] = 'Fiyatlandırma Ekle';
        $this->priceProfilModel = new PriceProfileModel();
        $profile = $this->priceProfilModel->getProfile($price_profile_id);
        if ($profile == null) {
            session()->setFlashdata('error', 'Ürün profili bulunamadı.');
            return redirect()->to('/admin/price-management');
        }
        $this->data['profile'] = $profile;
        $this->data['price_profile_id'] = $price_profile_id;

        if (
            $this->request->getMethod() == 'post'
        ) {
            $this->priceProfilModel->addPrice(
                [
                    'price' => doubleval($this->request->getPost('price')),
                    'frame_color_id' => ($this->request->getPost('product_frame_color') ?? (string)0),
                    'frame_size_id' => $this->request->getPost('product_frame_size'),
                    'frame_type_id' => $this->request->getPost('product_frame_type'),
                    'price_profile_id' => $price_profile_id,
                ]
            );
            session()->setFlashdata('success', 'Fiyat başarıyla eklendi.');
            return redirect()->to('/admin/price-management/view/' . $price_profile_id);
        }

        return view('admin/price_management/add', $this->data);
    }

    public function view_price($price_id)
    {
        $this->data['title'] = 'Fiyatlandırma Görüntüle #' . $price_id;
        $this->priceProfilModel = new PriceProfileModel();
        $price = $this->priceProfilModel->getPrice($price_id);
        if ($price == null) {
            session()->setFlashdata('error', 'Fiyat bulunamadı.');
            return redirect()->to('/admin/price-management');
        }
        $this->data['price'] = $price;
        $this->data['price_profile_id'] = $price['price_profile_id'];
        return view('admin/price_management/view_price', $this->data);
    }

    public function edit_price($price_id)
    {
        $this->data['title'] = 'Fiyatlandırma Görüntüle #' . $price_id;
        $this->priceProfilModel = new PriceProfileModel();
        $price = $this->priceProfilModel->getPrice($price_id);
        if ($price == null) {
            session()->setFlashdata('error', 'Fiyat bulunamadı.');
            return redirect()->to('/admin/price-management');
        }
        $this->data['price'] = $price;
        $this->data['price_profile_id'] = $price['price_profile_id'];
        if (
            $this->request->getMethod() == 'post'
        ) {
            $this->priceProfilModel->updatePrice(
                $price_id,
                [
                    'price' => doubleval($this->request->getPost('price')),
                    'frame_color_id' => ($this->request->getPost('product_frame_color') ?? (string)0),
                    'frame_size_id' => $this->request->getPost('product_frame_size'),
                    'frame_type_id' => $this->request->getPost('product_frame_type'),
                    'price_profile_id' => $price['price_profile_id'],
                ]
            );
            session()->setFlashdata('success', 'Fiyat başarıyla güncellendi.');
            return redirect()->to('/admin/price-management/view/' . $price['price_profile_id']);
        }

        return view('admin/price_management/edit_price', $this->data);
    }

    public function delete($price_id)
    {
        $this->priceProfilModel = new PriceProfileModel();
        $price = $this->priceProfilModel->getPrice($price_id);
        if ($price == null) {
            session()->setFlashdata('error', 'Fiyat bulunamadı.');
            return redirect()->to('/admin/price-management');
        }
        $this->priceProfilModel->deletePrice($price_id);
        session()->setFlashdata('success', 'Fiyat başarıyla silindi.');
        return redirect()->to('/admin/price-management/view/' . $price['price_profile_id']);
    }
}