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

    public function list() {
        return $this->orderservices->list();
    }
    public function details($id) {
        return $this->orderservices->details($id);
    }
    public function cancel($id) {
        return $this->orderservices->cancel($id);
    }
    public function returnOrder($id,Request $request) {
        return $this->orderservices->returnOrder($id,$request);
    }
}
