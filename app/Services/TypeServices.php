<?php

namespace App\Services;

use App\Http\Resources\TypesResources;
use App\Http\Resources\TypeWithCategories;
use App\Repositories\TypeRepository;
use App\Traits\ApiResponse;
use Exception;

class TypeServices
{
    use ApiResponse;
    protected $typerepo;
    public function __construct(
        TypeRepository $typerepo
    ) {
        $this->typerepo = $typerepo;
    }
    public function list()
    {
        try {
            $types = $this->typerepo->list();
            return $this->success(TypesResources::collection($types), 'list types success');
        } catch (Exception $e) {
            return $this->fail('fail in show list');
        }
    }
    public function listWithCategories()
    {
        try {
            $typesCategories = $this->typerepo->listWithCategories();
            return $this->success(TypeWithCategories::collection($typesCategories), 'list types categories success');
        } catch (Exception $e) {
            return $this->fail('fail in show list');
        }
    }
}
