<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendOrderRequest;
use App\Models\Order;
use App\Services\OrderServices;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderservices;
    public function __construct(
        OrderServices $orderservices
    ) {
        $this->orderservices = $orderservices;
    }
    public function checkout(SendOrderRequest $request) {
        return $this->orderservices->checkout($request->validated());
    }
}
