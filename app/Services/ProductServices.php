<?php

namespace App\Services;

use App\Http\Resources\ProductResources;
use App\Http\Resources\TypesResources;
use App\Http\Resources\TypeWithCategories;
use App\Repositories\ProductRepository;
use App\Repositories\TypeRepository;
use App\Traits\ApiResponse;
use Exception;

class ProductServices
{
    use ApiResponse;
    protected $productrepo;
    public function __construct(
        ProductRepository $productrepo
    ) {
        $this->productrepo = $productrepo;
    }
    public function list()
    {
        try {
            $types = $this->productrepo->list();
            return $this->success(ProductResources::collection($types), 'list types success');
        } catch (Exception $e) {
            return $this->fail('fail in show list'.$e);
        }
    }

}
