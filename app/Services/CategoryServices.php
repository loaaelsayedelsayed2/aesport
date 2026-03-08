<?php

namespace App\Services;

use App\Http\Resources\CategoriesResource;
use App\Http\Resources\TypesResources;
use App\Http\Resources\TypeWithCategories;
use App\Repositories\CategoryRepository;
use App\Repositories\TypeRepository;
use App\Traits\ApiResponse;
use Exception;

class CategoryServices
{
    use ApiResponse;
    protected $categoryRepo;
    public function __construct(
        CategoryRepository $categoryRepo
    ) {
        $this->categoryRepo = $categoryRepo;
    }
    public function list()
    {
        try {
            $types = $this->categoryRepo->list();
            return $this->success(CategoriesResource::collection($types), 'list categories success');
        } catch (Exception $e) {
            return $this->fail('fail in show list');
        }
    }

}
