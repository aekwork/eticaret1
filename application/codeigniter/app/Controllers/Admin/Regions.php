<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RegionModel;

class Regions extends BaseController
{
    public function index(): string
    {
        $this->data['title'] = 'Bölgeler';
        $regionModel = new RegionModel();
        $this->data['regions'] = $regionModel->getRegions();
        return view('admin/regions/index', $this->data);
    }

    public function add(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $this->data['title'] = 'Bölge Ekle';

        if (
            $this->request->getMethod() == 'post'
        ) {
            $data = [
                'name' => $this->request->getPost('region_name'),
                'price' => $this->request->getPost('price_impact'),
            ];

            foreach ($data as $val) {
                if (empty($val)) {
                    session()->setFlashdata('error', 'Lütfen tüm alanları doldurunuz.');
                    return redirect()->to('/admin/regions/add');
                }
            }

            $regionModel = new RegionModel();
            $regionModel->insert($data);
            session()->setFlashdata('success', 'Bölge başarıyla eklendi.');
            return redirect()->to('/admin/regions');
        }

        return view('admin/regions/add', $this->data);
    }

    public function edit(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $this->data['title'] = 'Bölge Düzenle';
        $regionModel = new RegionModel();
        $regionId = $this->request->uri->getSegment(4);
        $this->data['region'] = $regionModel->getRegion($regionId);

        if (
            $this->request->getMethod() == 'post'
        ) {
            $data = [
                'name' => $this->request->getPost('region_name'),
                'price' => $this->request->getPost('price_impact'),
            ];

            foreach ($data as $val) {
                if (empty($val)) {
                    session()->setFlashdata('error', 'Lütfen tüm alanları doldurunuz.');
                    return redirect()->to('/admin/regions/edit/' . $regionId);
                }
            }

            $regionModel->update($regionId, $data);
            session()->setFlashdata('success', 'Bölge başarıyla düzenlendi.');
            return redirect()->to('/admin/regions');
        }

        return view('admin/regions/edit', $this->data);
    }

    public function delete(): \CodeIgniter\HTTP\RedirectResponse
    {
        $regionModel = new RegionModel();
        $regionId = $this->request->uri->getSegment(4);
        foreach (
            $regionModel->getRegions() as $region
        ) {
            if ($region['id'] == $regionId && $region['country_count'] > 0) {
                session()->setFlashdata('error', 'Bu bölgeye bağlı ülkeler olduğu için silinemez.');
                return redirect()->to('/admin/regions');
            }
        }
        $regionModel->delete($regionId);
        session()->setFlashdata('success', 'Bölge başarıyla silindi.');
        return redirect()->to('/admin/regions');
    }
}
