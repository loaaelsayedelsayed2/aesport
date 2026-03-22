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
    function cartTotal($item, $quantity)
    {
        $total = 0;
        $total += $item['price'] * $quantity;
        return $total;
    }
}

if (!function_exists('calcAmountCoupon')) {
    function calcAmountCoupon(string $type, float $value, float $cartTotal): float|string
    {
        switch ($type) {
            case 'free_shipping':
                $finalValue =  0.0;
                break;
            case 'fixed':
                $finalValue =  $value;
                break;
            case 'percentage':
                $finalValue =  round(($value / 100) * $cartTotal, 2);
                break;
            default:
                $finalValue =  0.0;
                break;
        }
        return $finalValue;
    }
}



if (!function_exists('calcFinalTotal')) {
    function calcFinalTotal()
    {
        // $total = 0;
        // return $total;
    }
}
