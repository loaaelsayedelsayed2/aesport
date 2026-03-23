<?php

namespace App\Services;

use App\Http\Resources\OrderDetailsResources;
use App\Http\Resources\UserOrdersResources;
use App\Repositories\OrderRepository;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderServices
{
    use ApiResponse;
    protected $orderRepo;
    public function __construct(
        OrderRepository $orderRepo,
    ) {
        $this->orderRepo = $orderRepo;
    }

    public function checkout($request)
    {
        DB::beginTransaction();
        try {
            $user = auth('api')->user();
            $cart = $user->cart;
            $order = $this->orderRepo->create($request, $cart);
            foreach ($cart->items as $item) {
                $orderItem = $this->orderRepo->createItem($order, $item);
            }
            $data = [
                "cheeckUrl" => 'http:paymentlink'
            ];
            $cart->items()->delete();
            $cart->delete();
            DB::commit();
            return $this->success($data, 'send order successfuly');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->fail('send order failed' . $e);
        }
    }
    public function list()
    {
        try {
            $user = auth('api')->user();
            $orders = $this->orderRepo->list();
            return $this->success(UserOrdersResources::collection($orders), 'show order successfuly');
        } catch (Exception $e) {
            return $this->fail('show order failed' . $e);
        }
    }
    public function details($id)
    {
        try {
            $user = auth('api')->user();
            $order = $this->orderRepo->getById($id);
            if (!$order) {
                return $this->notFound('this order not found');
            }
            return $this->success(new OrderDetailsResources($order), 'show order successfuly');
        } catch (Exception $e) {
            return $this->fail('show order failed' . $e);
        }
    }
    public function cancel($id)
    {
        try {
            $user = auth('api')->user();
            $order = $this->orderRepo->getById($id);
            if (!$order) {
                return $this->notFound('this order not found');
            }
            $order = $this->orderRepo->updateCancel($id);
            return $this->success(new OrderDetailsResources($order), 'cancel order successfuly');
        } catch (Exception $e) {
            return $this->fail('cancel order failed' . $e);
        }
    }
    public function returnOrder($id)
    {
        try {
            $user = auth('api')->user();
            $order = $this->orderRepo->getById($id);
            if (!$order) {
                return $this->notFound('this order not found');
            }
            if ($order->status !== 'delivered') {
                return $this->fail('you can only return delivered orders');
            }

            $order->update(['status' => 'returned']);
            return $this->success(new OrderDetailsResources($order), 'return order successfuly');
        } catch (Exception $e) {
            return $this->fail('return order failed' . $e);
        }
    }
}
