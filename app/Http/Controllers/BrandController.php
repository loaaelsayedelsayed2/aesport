<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Services\BrandsServices;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $brandServices;
    public function __construct(
        BrandsServices $brandServices
    ) {
        $this->brandServices = $brandServices;
    }
    public function list()
    {
        return $this->brandServices->list();
    }
}
