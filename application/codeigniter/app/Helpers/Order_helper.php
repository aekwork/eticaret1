<?php

namespace App\Helpers;

use App\Models\StatusModel;
use App\Models\UserModel;

if (
    !function_exists('getOrderStatus')
) {
    function getOrderStatus($status_int): string
    {
        $statusModel = new StatusModel();
        $status = $statusModel->where('id', $status_int)->first();
        if ($status) {
            return $status['name'];
        } else {
            return 'Bilinmiyor';
        }
    }
}

if (
    !function_exists('getOrderDefaultStatus')
) {
    function getOrderDefaultStatus()
    {
        $statusModel = new StatusModel();
        $status = $statusModel->where('default', 1)->first();
        if ($status) {
            return $status['id'];
        } else {
            return 0;
        }
    }
}

    if (
        !function_exists('getUserPriceProfile')
    ) {
        function getUserPriceProfile($id)
        {
            $userModel = new UserModel();
            $user = $userModel->where('id', $id)->first();
            return $user['price_profile_id'];
        }
    }