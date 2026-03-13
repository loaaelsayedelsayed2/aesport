<?php

namespace App\Services;

use App\Http\Resources\ProductResources;
use App\Http\Resources\TypesResources;
use App\Http\Resources\TypeWithCategories;
use App\Repositories\ProductFavRepository;
use App\Repositories\ProductRepository;
use App\Repositories\TypeRepository;
use App\Traits\ApiResponse;
use Exception;

class ProductServices
{
    use ApiResponse;
    protected $productrepo, $ProductFavRepo;
    public function __construct(
        ProductRepository $productrepo,
        ProductFavRepository $ProductFavRepo
    ) {
        $this->productrepo = $productrepo;
        $this->ProductFavRepo = $ProductFavRepo;
    }
    public function list()
    {
        try {
            $types = $this->productrepo->list();
            return $this->success(ProductResources::collection($types), 'list types success');
        } catch (Exception $e) {
            return $this->fail('fail in show list' . $e);
        }
    }
    public function addFavorites($request)
    {
        try {
            $product = $this->ProductFavRepo->getFavoriteProduct($request['product_id']);
            if (!$product) {
                $data = [
                    'user_id' => auth('api')->user()->id,
                    'product_id' => $request['product_id'],
                ];
                $product = $this->ProductFavRepo->addFavorites($data);
                $message = "add product to fav list success";
            } else {
                $product = $this->ProductFavRepo->removeFavorites($product);
                $message = "remove product from fav list success";
            }
            return $this->success([], $message);
        } catch (Exception $e) {
            return $this->fail('fail in request' . $e);
        }
    }
}
