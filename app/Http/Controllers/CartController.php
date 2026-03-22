<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\ChangeQuantityRequest;
use App\Http\Requests\UseCouponRequest;
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
    public function showCart(){
        return $this->cartservices->showCart();
    }
    public function removeFromCart($id){
        return $this->cartservices->removeFromCart($id);
    }
    public function changeQuantity($id,ChangeQuantityRequest $request){
        return $this->cartservices->changeQuantity($id,$request);
    }
    public function useCoupon(UseCouponRequest $request){
        return $this->cartservices->useCoupon($request);
    }
}
