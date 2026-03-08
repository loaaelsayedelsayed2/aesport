<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Services\TypeServices;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    protected $typeServices;
    public function __construct(
        TypeServices $typeServices
    ) {
        $this->typeServices = $typeServices;
    }
    public function list()
    {
        return $this->typeServices->list();
    }
    public function listWithCategories()
    {
        return $this->typeServices->listWithCategories();
    }
}
