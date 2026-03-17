<?php

namespace App\Helpers;

if (!function_exists('generate_otp')) {
    function generate_otp()
    {
        $OTP = rand(1000, 9999);
        return $OTP;
    }
}

if (!function_exists('cartTotal')) {
    function cartTotal($item,$quantity)
    {
        $total = 0;
        $total += $item['price'] * $quantity;
        return $total;
    }
}

if (!function_exists('calcFinalTotal')) {
    function calcFinalTotal()
    {
        // $total = 0;
        // return $total;
    }
}
