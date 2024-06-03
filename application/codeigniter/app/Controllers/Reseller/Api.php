<?php

namespace App\Controllers\Reseller;

use App\Controllers\BaseController;
use App\Models\CountryPricingRegionModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use CodeIgniter\HTTP\ResponseInterface;

class Api extends BaseController
{
    private ProductModel $productModel;

    public function index()
    {
        //
    }

    public function getProductFrameSizes(): ResponseInterface
    {
        $user_id = $this->request->getPost('user_id') ?? session()->get('id');
        $this->productModel = new ProductModel();
        return $this->response->setJSON($this->productModel->getProductFrameSizes($user_id));
    }

    public function getAllProductFrameSizes(): ResponseInterface
    {
        $this->productModel = new ProductModel();
        return $this->response->setJSON($this->productModel->getAllProductFrameSizes());
    }

    public function getProductFrameColors(): ResponseInterface
    {
        $user_id = $this->request->getPost('user_id') ?? session()->get('id');
        $frame_size_id = $this->request->getPost('frame_size_id') ?? $this->request->getPost('product_frame_size');
        $frame_type_id = $this->request->getPost('frame_type_id') ?? $this->request->getPost('product_frame_type');
        $this->productModel = new ProductModel();
        return $this->response->setJSON($this->productModel->getProductFrameColors($frame_size_id, $frame_type_id, $user_id));
    }

    public function getAllProductFrameColors(): ResponseInterface
    {
        $this->productModel = new ProductModel();
        return $this->response->setJSON($this->productModel->getAllProductFrameColors());
    }

    public function getProductFrameTypes(): ResponseInterface
    {
        $user_id = $this->request->getPost('user_id') ?? session()->get('id');
        $frame_size_id = $this->request->getPost('frame_size_id') ?? $this->request->getPost('product_frame_size');
        $this->productModel = new ProductModel();
        return $this->response->setJSON($this->productModel->getProductFrameTypes($frame_size_id, $user_id));
    }

    public function getAllProductFrameTypes(): ResponseInterface
    {
        $this->productModel = new ProductModel();
        return $this->response->setJSON($this->productModel->getAllProductFrameTypes());
    }

    public function getRecipientCountries(): ResponseInterface
    {
        $recipientModel = new CountryPricingRegionModel();
        return $this->response->setJSON($recipientModel->getRecipientCountries());
    }

    public function calculatePriceTotal(): ResponseInterface
    {
        $product_frame_size = $this->request->getPost('product_frame_size');
        $product_frame_type = $this->request->getPost('product_frame_type');
        $product_frame_color = $this->request->getPost('product_frame_color');
        $recipient_country = $this->request->getPost('recipient_country');
        $gift_package = $this->request->getPost('gift_package');
        $user_id = $this->request->getPost('user_id') ?? session()->get('id');
        $orderModel = new OrderModel();
        return $this->response->setJSON(
            $orderModel->calculatePriceTotal(
                $product_frame_size,
                $product_frame_type,
                $product_frame_color,
                $recipient_country,
                $gift_package,
                $user_id
            )
        );
    }

    public function getRegions(): ResponseInterface
    {
        $recipientModel = new CountryPricingRegionModel();
        return $this->response->setJSON($recipientModel->getRegions());
    }
}
