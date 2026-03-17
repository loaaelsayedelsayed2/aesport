<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Services\CartServices;

class CartController extends Controller
{
    protected $cartservices;
    public function __construct(
        CartServices $cartservices
    ) {
        $this->cartservices = $cartservices;
    }
    public function addToCart(AddToCartRequest $request){
        return $this->cartservices->addToCart($request->validated());
    }
}
