<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryServices;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $categoryServices;
    public function __construct(
        CategoryServices $categoryServices
    ) {
        $this->categoryServices = $categoryServices;
    }
    public function list()
    {
        return $this->categoryServices->list();
    }


}
