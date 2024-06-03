<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class FrameColors extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $this->data['title'] = 'Çerçeve Renkleri';
        $this->data['colors'] = $productModel->getColorNames();
        return view('admin/frame_colors/index', $this->data);
    }

    public function add()
    {
        $this->data['title'] = 'Çerçeve Rengi Ekle';

        if (
            $this->request->getMethod() == 'post'
        ) {
            $data = [
                'color_name' => $this->request->getPost('color_name')
            ];

            foreach ($data as $val) {
                if (empty($val)) {
                    session()->setFlashdata('error', 'Lütfen tüm alanları doldurunuz.');
                    return redirect()->to('/admin/frame-colors/add');
                }
            }

            $productModel = new ProductModel();
            $productModel->insertColorName($data);
            session()->setFlashdata('success', 'Çerçeve rengi başarıyla eklendi.');
            return redirect()->to('/admin/frame-colors');
        }

        return view('admin/frame_colors/add', $this->data);
    }

    public function edit($id)
    {
        $productModel = new ProductModel();
        $this->data['title'] = 'Çerçeve Rengi Düzenle';
        $this->data['color'] = $productModel->getColorName($id);

        if (
            $this->request->getMethod() == 'post'
        ) {
            $data = [
                'color_name' => $this->request->getPost('color_name')
            ];

            foreach ($data as $val) {
                if (empty($val)) {
                    session()->setFlashdata('error', 'Lütfen tüm alanları doldurunuz.');
                    return redirect()->to('/admin/frame-colors/edit/' . $id);
                }
            }

            $productModel->updateColorName($id, $data);
            session()->setFlashdata('success', 'Çerçeve rengi başarıyla güncellendi.');
            return redirect()->to('/admin/frame-colors');
        }

        return view('admin/frame_colors/edit', $this->data);
    }

    public function delete()
    {
        $productModel = new ProductModel();
        $id = $this->request->uri->getSegment(4);
        $productModel->deleteColorName($id);
        session()->setFlashdata('success', 'Çerçeve rengi başarıyla silindi.');
        return redirect()->to('/admin/frame-colors');
    }
}
