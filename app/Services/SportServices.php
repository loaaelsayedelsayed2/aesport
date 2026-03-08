<?php

namespace App\Services;

use App\Http\Resources\CategoriesResource;
use App\Http\Resources\SportsResource;
use App\Http\Resources\TypesResources;
use App\Http\Resources\TypeWithCategories;
use App\Repositories\CategoryRepository;
use App\Repositories\SportsRepository;
use App\Repositories\TypeRepository;
use App\Traits\ApiResponse;
use Exception;

class SportServices
{
    use ApiResponse;
    protected $sportsRepo;
    public function __construct(
        SportsRepository $sportsRepo
    ) {
        $this->sportsRepo = $sportsRepo;
    }
    public function list()
    {
        try {
            $types = $this->sportsRepo->list();
            return $this->success(SportsResource::collection($types), 'list categories success');
        } catch (Exception $e) {
            return $this->fail('fail in show list');
        }
    }

}
