<?php

namespace App\Services;

use App\Http\Resources\CartsResource;
use App\Repositories\CartItemsRepository;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use function App\Helpers\cartTotal;

class CartServices
{
    use ApiResponse;
    protected $cartRepo, $productRepo, $cartItemRepo;
    public function __construct(
        CartRepository $cartRepo,
        CartItemsRepository $cartItemRepo,
        ProductRepository $productRepo,
    ) {
        $this->cartRepo = $cartRepo;
        $this->productRepo = $productRepo;
        $this->cartItemRepo = $cartItemRepo;
    }
    public function addToCart($request)
    {
        DB::beginTransaction();
        try {
            $userId = auth('api')->user()->id;
            $product = $this->productRepo->getById($request['product_id']);
            if ($product->quantity < 1) {
                DB::commit();
                return $this->fail([], 'product out of stock');
            }
            $cart = $this->createCart($request, $userId, $product);
            $CartItem = $this->createCartItem($request, $product, $cart);
            DB::commit();
            return $this->success([], 'add cart success');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->fail('fail in show list' . $e);
        }
    }

    public function createCart($request, $userId, $product)
    {
        $getCart = $this->cartRepo->showCart();
        $qty = $request['quantity'] ?? 1;
        $subTotal = cartTotal($product, $qty);
        if (!$getCart) {
            $data = [
                "user_id" => $userId,
                "cart_number" => Str::random(7),
                "sub_total" => $subTotal,
                "quantity" => $qty ?? 1,
                // "delivery_fee", // ToDo:delivery fees
                "final_total" => $product->price
            ];
            $cart = $this->cartRepo->create($data);
        } else {
            $cart = $getCart;
        }
        return $cart;
    }
    public function createCartItem($request, $product, $cart)
    {
        $getCartItem = $this->cartItemRepo->getItem(
            $product->id,
            $cart,
            $request['size'] ?? null,
            $request['color'] ?? null
        );
        if (!$getCartItem) {
            $cartItem = $this->cartItemRepo->createItem($request, $product, $cart);
            $qty = $request['quantity'] ?? 1;
            $updateData = [
                "sub_total" => cartTotal($product, $qty),
                "quantity" => $qty,
                "final_total" => cartTotal($product, $qty)
            ];
            $updateCart = $this->cartRepo->updateCart($updateData);
            return;
        } else {
            return $this->fail([], 'this product aleady exsist');
        }
    }

    public function showCart()
    {
        try {
            $cart = $this->cartRepo->showCart();
            return $this->success(new CartsResource($cart), 'show cart success');
        } catch (Exception $e) {
            return $this->fail('fail in show cart' . $e);
        }
    }
}
