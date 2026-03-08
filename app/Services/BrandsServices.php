<?php

namespace App\Services;

use App\Http\Resources\BrandsResource;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\TypesResources;
use App\Http\Resources\TypeWithCategories;
use App\Repositories\BrandsRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TypeRepository;
use App\Traits\ApiResponse;
use Exception;

class BrandsServices
{
    use ApiResponse;
    protected $brandRepo;
    public function __construct(
        BrandsRepository $brandRepo
    ) {
        $this->brandRepo = $brandRepo;
    }
    public function list()
    {
        try {
            $types = $this->brandRepo->list();
            return $this->success(BrandsResource::collection($types), 'list categories success');
        } catch (Exception $e) {
            return $this->fail('fail in show list');
        }
    }

}
