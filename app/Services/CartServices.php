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
                "quantity" => $cart->quantity + 1,
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
    public function removeFromCart($id)
    {
        DB::beginTransaction();
        try {
            $item = $this->cartItemRepo->getItemById($id);
            $cart = $this->cartRepo->showCart();
            if(!$item){
                return $this->notFound('this item not found in cart');
            }
            $updateData = [
                "sub_total" => $cart->sub_total - $item->total_price,
                "quantity" => $cart->quantity - 1,
                "final_total" => $cart->final_total - $item->total_price
            ];
            $this->cartRepo->updateCart($updateData);
            $this->cartItemRepo->removeFromCart($id);
            DB::commit();
            return $this->success([], 'remove from cart success');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->fail('fail in remove from cart' . $e);
        }
    }
    public function changeQuantity($id,$request)
    {
        DB::beginTransaction();
        try {
            $cart = $this->cartRepo->showCart();
            $item = $this->cartItemRepo->getItemById($id);
            if(!$item){
                return $this->notFound('this item not found in cart');
            }
            $newSubTotal = $item->product->price * $request['qty'];
            $newFinalTotal = $item->product->price * $request['qty'];
            $data = [
                "sub_total" => ($cart->sub_total - $item->total_price) + $newSubTotal,
                "quantity" => $request['qty'],
                "final_total" => ($cart->final_total - $item->total_price) + $newFinalTotal
            ];
            $dataItem = [
                "price" => $newSubTotal,
                "quantity" => $request['qty'],
                "total_price" => $newFinalTotal
            ];
            $this->cartRepo->updateCart($data);
            $this->cartItemRepo->updateQuantity($dataItem,$id);
            DB::commit();
            return $this->success([], 'change Quantity from cart success');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->fail('fail in change Quantity from cart' . $e);
        }
    }
}
