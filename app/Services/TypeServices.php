<?php

namespace App\Services;

use App\Http\Resources\TypesResources;
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
}
