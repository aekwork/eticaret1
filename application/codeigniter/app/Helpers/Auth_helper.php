<?php

namespace App\Helpers;

use App\Models\UserModel;
use App\Models\AdminModel;

if (!function_exists('isUserValid')) {
    function isUserValid(string $email, string $password): bool
    {
        $userModel = new UserModel();
        $userData = $userModel->where('email', $email)->first();

        if (!$userData) {
            return false;
        }

        return password_verify($password, $userData['password']);
    }
}

if (!function_exists('getUserId')) {
    function getUserId(string $email): int
    {
        $userModel = new UserModel();
        $userData = $userModel->where('email', $email)->first();

        if (!$userData) {
            return 0;
        }

        return $userData['id'];
    }
}

if (!function_exists('isAdminValid')) {
    function isAdminValid(string $email, string $password): bool
    {
        $adminModel = new AdminModel();
        $adminData = $adminModel->where('email', $email)->first();

        if (!$adminData) {
            return false;
        }

        return password_verify($password, $adminData['password']);
    }
}

if (!function_exists('getAdminId')) {
    function getAdminId(string $email): int
    {
        $adminModel = new AdminModel();
        $adminData = $adminModel->where('email', $email)->first();

        if (!$adminData) {
            return 0;
        }

        return $adminData['id'];
    }
}