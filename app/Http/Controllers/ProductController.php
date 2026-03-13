<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFavRequest;
use App\Models\Product;
use App\Services\ProductServices;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    public function __construct(
        ProductServices $productService
    ) {
        $this->productService = $productService;
    }
    public function list() {
        return $this->productService->list();
    }
    public function addFavorites(ProductFavRequest $request) {
        return $this->productService->addFavorites($request->validated());
    }
}
