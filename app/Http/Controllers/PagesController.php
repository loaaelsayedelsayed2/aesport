<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Services\BrandsServices;
use App\Services\pagesServices;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    protected $pagesServices;
    public function __construct(
        pagesServices $pagesServices
    ) {
        $this->pagesServices = $pagesServices;
    }
    public function home()
    {
        return $this->pagesServices->home();
    }
    public function showInfo()
    {
        return $this->pagesServices->showInfo();
    }
    public function getBanners()
    {
        return $this->pagesServices->getBanners();
    }
}
