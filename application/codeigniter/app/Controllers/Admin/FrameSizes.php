<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class FrameSizes extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $this->data['title'] = 'Çerçeve Boyutları';
        $this->data['sizes'] = $productModel->getFrameSizes();
        return view('admin/frame_sizes/index', $this->data);
    }

    public function add()
    {
        $this->data['title'] = 'Çerçeve Boyutu Ekle';

        if (
            $this->request->getMethod() == 'post'
        ) {
            $data = [
                'size' => $this->request->getPost('frame_size')
            ];

            foreach ($data as $val) {
                if (empty($val)) {
                    session()->setFlashdata('error', 'Lütfen tüm alanları doldurunuz.');
                    return redirect()->to('/admin/frame-sizes/add');
                }
            }

            $productModel = new ProductModel();
            $productModel->insertFrameSize($data);
            session()->setFlashdata('success', 'Çerçeve boyutu başarıyla eklendi.');
            return redirect()->to('/admin/frame-sizes');
        }

        return view('admin/frame_sizes/add', $this->data);
    }

    public function edit($id)
    {
        $productModel = new ProductModel();
        $this->data['title'] = 'Çerçeve Boyutu Düzenle';
        $this->data['size'] = $productModel->getFrameSize($id);

        if (
            $this->request->getMethod() == 'post'
        ) {
            $data = [
                'size' => $this->request->getPost('frame_size')
            ];

            foreach ($data as $val) {
                if (empty($val)) {
                    session()->setFlashdata('error', 'Lütfen tüm alanları doldurunuz.');
                    return redirect()->to('/admin/frame-sizes/edit/' . $id);
                }
            }

            $productModel->updateFrameSize($id, $data);
            session()->setFlashdata('success', 'Çerçeve boyutu başarıyla güncellendi.');
            return redirect()->to('/admin/frame-sizes');
        }

        return view('admin/frame_sizes/edit', $this->data);
    }

    public function delete()
    {
        $productModel = new ProductModel();
        $id = $this->request->uri->getSegment(4);
        $productModel->deleteFrameSize($id);
        session()->setFlashdata('success', 'Çerçeve boyutu başarıyla silindi.');
        return redirect()->to('/admin/frame-sizes');
    }
}
