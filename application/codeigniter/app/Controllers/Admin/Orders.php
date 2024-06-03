<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\StatusModel;
use App\Models\UserModel;
use function App\Helpers\getOrderDefaultStatus;

helper('Order_helper');

class Orders extends BaseController
{

    public function index()
    {
        $orderModel = new OrderModel();
        $userModeL = new UserModel();
        $statusModel = new StatusModel();
        $statusCode = $this->request->getGet('status_code') ?? getOrderDefaultStatus();
        $user_id = $this->request->getGet('user_id') ?? null;
        $start_date = $this->request->getVar('start_date');
        $end_date = $this->request->getVar('end_date');
        if (preg_match('/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{4}$/', $start_date)) {
            $start_date = explode('.', $start_date);
            $start_date = $start_date[2] . '-' . (strlen($start_date[1]) == 1 ? '0' . $start_date[1] : $start_date[1]) . '-' . $start_date[0];
        }
        if (preg_match('/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{4}$/', $end_date)) {
            $end_date = explode('.', $end_date);
            $end_date = $end_date[2] . '-' . (strlen($end_date[1]) == 1 ? '0' . $end_date[1] : $end_date[1]) . '-' . $end_date[0];
        }
        $this->data['title'] = 'Siparişler';
        if (!empty($start_date) && !empty($end_date)) {
            $this->data['orders'] = $orderModel->getOrders($statusCode, $user_id, $start_date, $end_date);
        } elseif (!empty($start_date) && empty($end_date)){
            $this->data['orders'] = $orderModel->getOrders($statusCode, $user_id, $start_date);
        } elseif (empty($start_date) && !empty($end_date)){
            $this->data['orders'] = $orderModel->getOrders($statusCode, $user_id, null, $end_date);
        } elseif (empty($start_date) && empty($end_date)){
            $this->data['orders'] = $orderModel->getOrders($statusCode, $user_id);
        }
        $this->data['status_codes'] = $statusModel->findAll();
        $this->data['statusCode'] = $statusCode;
        if (!is_null($user_id)) {
            $this->data['user_id'] = $user_id;
        } else {
            $this->data['user_id'] = null;
        }
        if (
            count($this->data['orders']) > 0
        ) {
            $user_id = $this->data['orders'][0]['user_id'];
            $this->data['reseller'] = $userModeL->getUser($user_id);
        } else {
            $this->data['reseller'] = [];
        }
        return view('admin/orders/index', $this->data);
    }

    public
    function view($id)
    {
        $orderModel = new OrderModel();
        $this->data['title'] = 'Sipariş Detayı';
        $this->data['order'] = $orderModel->getOrderDetail($id, false);
        if (
            $this->data['order'] == null
        ) {
            session()->setFlashdata('error', 'Sipariş bulunamadı.');
            return redirect()->to('/admin/orders');
        }
        return view('admin/orders/view', $this->data);
    }

    public
    function edit($id)
    {
        $orderModel = new OrderModel();
        $statusModel = new StatusModel();
        $this->data['title'] = 'Sipariş Düzenle';
        $this->data['order'] = $orderModel->getOrderDetail($id, false);
        $this->data['status_codes'] = $statusModel->findAll();
        if (
            $this->data['order'] == null
        ) {
            session()->setFlashdata('error', 'Sipariş bulunamadı.');
            return redirect()->to('/admin/orders');
        }

        if (
            $this->request->getMethod() == 'post'
        ) {
            $id = $this->data['order']['order_id'];
            $product_code = $this->data['order']['product_code'];
            $user_id = $this->data['order']['user_id'];
            $product_frame_size_id = $this->request->getPost('product_frame_size');
            $product_frame_type = $this->request->getPost('product_frame_type');
            if ($product_frame_type == '1') {
                $product_frame_color_id = $this->request->getPost('product_frame_color');
            } else {
                $product_frame_color_id = '0';
            }
            $recipient_country_id = $this->request->getPost('recipient_country');
            $recipient_name = $this->request->getPost('recipient_name');
            $recipient_email = $this->request->getPost('recipient_email');
            $recipient_phone = $this->request->getPost('recipient_phone');
            $recipient_address = $this->request->getPost('recipient_address');
            $recipient_iossvat = $this->request->getPost('recipient_iossvat');
            $gift_package = $this->request->getPost('gift_package');
            $order_status = $this->request->getPost('status');
            $product_image = $this->request->getFile('product_image');
            $order_note = $this->request->getPost('order_note');
            if (
                empty($product_code) ||
                empty($product_frame_size_id) ||
                empty($product_frame_type) ||
                (
                    empty($product_frame_color_id) &&
                    $product_frame_type !== '2'
                ) || empty($recipient_country_id) ||
                empty($recipient_name) ||
                empty($recipient_email) ||
                empty($recipient_address) ||
                empty($gift_package)) {
                $this->session->setFlashdata('error', 'Lütfen tüm alanları doldurunuz.');
                var_dump($this->request->getPost(), empty($product_code), empty($product_frame_size_id), empty($product_frame_type), empty($product_frame_color_id), empty($recipient_country_id), empty($recipient_name), empty($recipient_email), empty($recipient_phone), empty($recipient_address), empty($recipient_iossvat), empty($gift_package));
                exit;
            }

            if (!empty($product_image)) {
                $product_image_name = $product_image->getRandomName();
                $product_image->move('assets/uploads', $product_image_name);

                \Config\Services::image()
                    ->withFile('assets/uploads/' . $product_image_name)->resize(
                        195, 200, true, 'height'
                    )->save('assets/uploads/thumbnails/' . $product_image_name);
            } else {
                $product_image_name = str_replace('assets/uploads/', '', $this->data['order']['product_image']);
            }

            $this->orderModel = new OrderModel();
            if (
                $this->orderModel->updateOrder(
                    $id,
                    $product_code,
                    'assets/uploads/' . $product_image_name,
                    'assets/uploads/thumbnails/' . $product_image_name,
                    $product_frame_size_id,
                    $product_frame_type,
                    $product_frame_color_id,
                    $recipient_name,
                    $recipient_email,
                    $recipient_phone,
                    $recipient_address,
                    $recipient_iossvat,
                    $recipient_country_id,
                    $gift_package,
                    $this->orderModel->calculatePriceTotal(
                        $product_frame_size_id,
                        $product_frame_type,
                        $product_frame_color_id,
                        $recipient_country_id,
                        $gift_package,
                        $user_id
                    ),
                    $order_status,
                    $order_note,
                    $user_id
                )
            ) {
                $this->session->setFlashdata('success', 'Sipariş başarıyla güncellendi.');
                return redirect()->to('/admin/orders');
            } else {
                $this->session->setFlashdata('error', 'Sipariş güncellenirken bir hata oluştu.');
                return redirect()->to('/admin/orders');
            }
        }

        return view('admin/orders/edit', $this->data);
    }

    public
    function delete()
    {
        $orderModel = new OrderModel();
        $orderModel->delete($this->request->uri->getSegment(4));
        session()->setFlashdata('success', 'Sipariş başarıyla silindi.');
        return redirect()->to('/admin/resellers');
    }
}
