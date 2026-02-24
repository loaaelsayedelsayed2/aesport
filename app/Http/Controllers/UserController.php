<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Services\AuthServices;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $authServices;
    public function __construct(
        AuthServices $authServices
    )
    {
        $this->authServices = $authServices;
    }
    Public function register(RegisterRequest $request)
    {
        return $this->authServices->register($request);
    }

    public function login(LoginRequest $request)
    {
        return $this->authServices->login($request);
    }
}
