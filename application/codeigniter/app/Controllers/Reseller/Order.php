<?php

namespace App\Controllers\Reseller;

use App\Controllers\BaseController;
use App\Models\OrderModel;

helper('Order_helper');

class Order extends BaseController
{
    public function index()
    {
        $this->data['title'] = 'Sipariş Ver';
        $this->data['product_code'] = $this->generateProductCode();
        return view('reseller/order', $this->data);
    }

    public function generateProductCode()
    {
        $result = '';
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
        for ($i = 0; $i < 3; $i++) {
            $result .= $characters[rand(0, strlen($characters) - 1)];
        }
        $result .= '-';
        for ($i = 0; $i < 3; $i++) {
            $result .= $numbers[rand(0, strlen($numbers) - 1)];
        }
        $result .= '-';
        $result .= $characters[rand(0, strlen($characters) - 1)];
        $result .= $numbers[rand(0, strlen($numbers) - 1)];
        $result .= $characters[rand(0, strlen($characters) - 1)];
        return $result;
    }

    public function my_orders()
    {
        $this->data['title'] = 'Siparişlerim';
        $this->orderModel = new OrderModel();
        $this->data['orders'] = $this->orderModel->getMyOrders();
        return view('reseller/my_orders', $this->data);
    }

    public function view($order_id)
    {
        $this->data['title'] = 'Sipariş Detayı';
        $this->orderModel = new OrderModel();
        $this->data['order'] = $this->orderModel->getOrderDetail($order_id);
        if (
            count($this->data['order']) == 0
        ) {
            return redirect()->to(base_url('my_orders'));
        }
        return view('reseller/view_order', $this->data);
    }

    public function create()
    {
        $product_code = $this->request->getPost('product_code');
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

        $product_image = $this->request->getFile('product_image');
        $gift_message = $this->request->getFile('gift_message');

        if (
            empty($product_code) ||
            empty($product_frame_size_id) ||
            empty($product_frame_type) ||
            (
                empty($product_frame_color_id) &&
                $product_frame_type !== '2'
            ) ||
            empty($recipient_country_id) ||
            empty($recipient_name) ||
            empty($recipient_email) ||
            empty($recipient_address) ||
            empty($gift_package) ||
            empty($product_image)
        ) {
            $this->session->setFlashdata('error', 'Lütfen tüm alanları doldurunuz.');
            return redirect()->to('/order');
        }

        $product_image_name = $product_image->getRandomName();
        $product_image->move('assets/uploads', $product_image_name);

        \Config\Services::image()
            ->withFile('assets/uploads/' . $product_image_name)->resize(
                195, 200, true, 'height'
            )->save('assets/uploads/thumbnails/' . $product_image_name);
        $isValidGiftMessage = 0;
        if (
            $gift_message->isValid()
        ) {
            $isValidGiftMessage = 1;
            $gift_message_name = $gift_message->getRandomName();
            $gift_message->move('assets/uploads/gift_messages', $gift_message_name);
        }
        $this->orderModel = new OrderModel();
        if (
            $this->orderModel->createNewOrder(
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
                $isValidGiftMessage ? 'assets/uploads/gift_messages/' . $gift_message_name : '',
                $this->orderModel->calculatePriceTotal(
                    $product_frame_size_id,
                    $product_frame_type,
                    $product_frame_color_id,
                    $recipient_country_id,
                    $gift_package,
                    $this->session->get('id')
                ),
                $this->session->get('id')
            )
        ) {
            $this->session->setFlashdata('success', 'Siparişiniz başarıyla oluşturuldu.');
            return redirect()->to('/my_orders');
        } else {
            $this->session->setFlashdata('error', 'Sipariş oluşturulurken bir hata oluştu. Bakiyeniz yetersiz.');
            return redirect()->to('/order');
        }
    }
}
