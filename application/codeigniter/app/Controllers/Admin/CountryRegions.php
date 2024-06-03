<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RegionModel;

class CountryRegions extends BaseController
{
    public function index()
    {
        $this->data['title'] = 'Ülke Bölgeleri';
        $regionModel = new RegionModel();
        $this->data['countries'] = $regionModel->getCountries();
        return view('admin/country_regions/index', $this->data);
    }

    public function add(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $this->data['title'] = 'Ülke Ekle';
        $regionModel = new RegionModel();
        $this->data['regions'] = $regionModel->getRegions();

        if (
            $this->request->getMethod() == 'post'
        ) {
            $data = [
                'country_name' => $this->request->getPost('country_name'),
                'country_short_code' => $this->request->getPost('country_short_code'),
                'region_id' => $this->request->getPost('region_id'),
            ];

            foreach ($data as $val) {
                if (empty($val)) {
                    session()->setFlashdata('error', 'Lütfen tüm alanları doldurunuz.');
                    return redirect()->to('/admin/country-regions/add');
                }
            }

            $regionModel = new RegionModel();
            if (
                $regionModel->addCountry($data)
            ) {
                session()->setFlashdata('success', 'Ülke başarıyla eklendi.');
                return redirect()->to('/admin/country-regions');
            } else {
                session()->setFlashdata('error', 'Ülke eklenirken bir hata oluştu.');
                return redirect()->to('/admin/country-regions/add');
            }
        }

        return view('admin/country_regions/add', $this->data);
    }

    public function edit(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $this->data['title'] = 'Ülke Düzenle';
        $regionModel = new RegionModel();
        $countryId = $this->request->uri->getSegment(4);
        $this->data['country'] = $regionModel->getCountry($countryId);
        $this->data['regions'] = $regionModel->getRegions();
        if (
            $this->request->getMethod() == 'post'
        ) {
            $data = [
                'country_name' => $this->request->getPost('country_name'),
                'country_short_code' => $this->request->getPost('country_short_code'),
                'region_id' => $this->request->getPost('region_id'),
            ];

            foreach ($data as $val) {
                if (empty($val)) {
                    session()->setFlashdata('error', 'Lütfen tüm alanları doldurunuz.');
                    return redirect()->to('/admin/country-regions/edit/' . $countryId);
                }
            }

            $regionModel = new RegionModel();
            if (
                $regionModel->editCountry($data, $countryId)
            ) {
                session()->setFlashdata('success', 'Ülke başarıyla düzenlendi.');
                return redirect()->to('/admin/country-regions');
            } else {
                session()->setFlashdata('error', 'Ülke düzenlenirken bir hata oluştu.');
                return redirect()->to('/admin/country-regions/edit/' . $countryId);
            }
        }

        return view('admin/country_regions/edit', $this->data);
    }

    public function view(): string
    {
        $this->data['title'] = 'Ülke Görüntüle';
        $regionModel = new RegionModel();
        $countryId = $this->request->uri->getSegment(4);
        $this->data['country'] = $regionModel->getCountry($countryId);
        $this->data['regions'] = $regionModel->getRegions();
        return view('admin/country_regions/view', $this->data);
    }

    public function delete(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $regionModel = new RegionModel();
        $countryId = $this->request->uri->getSegment(4);
        if (
            $regionModel->deleteCountry($countryId)
        ) {
            session()->setFlashdata('success', 'Ülke başarıyla silindi.');
            return redirect()->to('/admin/country-regions');
        } else {
            session()->setFlashdata('error', 'Ülke silinirken bir hata oluştu.');
            return redirect()->to('/admin/country-regions');
        }
    }
}
