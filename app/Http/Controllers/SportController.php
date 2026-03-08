<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Services\SportServices;
use Illuminate\Http\Request;

class SportController extends Controller
{

    protected $sportServices;
    public function __construct(
        SportServices $sportServices
    ) {
        $this->sportServices = $sportServices;
    }
    public function list()
    {
        return $this->sportServices->list();
    }

}
