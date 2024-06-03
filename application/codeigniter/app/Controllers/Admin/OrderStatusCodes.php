<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\StatusModel;
use function App\Helpers\getOrderDefaultStatus;

helper('Order_helper');

class OrderStatusCodes extends BaseController
{
    public function index()
    {
        $this->data['title'] = 'Sipariş Durum Kodları';
        $statusModel = new StatusModel();
        $this->data['status_codes'] = $statusModel->findAll();
        return view('admin/order_status_codes/index', $this->data);
    }

    public function create()
    {
        $this->data['title'] = 'Sipariş Durum Kodu Ekle';

        if ($this->request->getMethod() == 'post') {
            $statusModel = new StatusModel();
            $statusModel->save([
                //'name' => $this->request->getPost('name'),
                'default' => $this->request->getPost('default') ? 1 : 0
            ]);
            return redirect()->to('/admin/order-status-codes');
        }

        return view('admin/order_status_codes/create', $this->data);
    }

    public function edit($id)
    {
        $this->data['title'] = 'Sipariş Durum Kodu Düzenle';
        $statusModel = new StatusModel();
        $this->data['status_code'] = $statusModel->find($id);

        if ($this->request->getMethod() == 'post') {
            $statusModel->update($id, [
                'name' => $this->request->getPost('name'),
                'default' => $this->request->getPost('default') ? 1 : 0
            ]);
            return redirect()->to('/admin/order-status-codes');
        }

        return view('admin/order_status_codes/edit', $this->data);
    }

    public function delete($id)
    {
        $statusModel = new StatusModel();
        $statusModel->delete($id);
        return redirect()->to('/admin/order-status-codes');
    }

    public function make_default()
    {
        $id = $this->request->getPost('id');
        $statusModel = new StatusModel();
        $statusModel->update(getOrderDefaultStatus(), ['default' => 0]);
        $statusModel->update($id, ['default' => 1]);
        return redirect()->to('/admin/order-status-codes');
    }
}
