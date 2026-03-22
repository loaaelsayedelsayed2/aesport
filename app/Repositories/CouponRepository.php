<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Models\Coupon;

class CouponRepository
{
    public function getByCodeName($request){
        return Coupon::where('code',$request['coupon'])->first();
    }

}
