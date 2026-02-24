<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthServices
{
    use ApiResponse;

    protected $userRepository;
    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }
    public function register($request)
    {
        try {
            $password = Hash::make($request->password);
            $request->merge(['password' => $password]);
            $user = $this->userRepository->create($request->validated());
            return $this->success($user, "Registration successful , Go to login");
        } catch (\Exception $e) {
            return $this->fail([], "Registration failed");
        }
    }
public function login($request)
{
    try {

        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return $this->fail([], "Invalid credentials");
        }

        $data = [
            'access_token' => $token,
            'token_type'   => 'bearer',
        ];
        return $this->success($data, "Login successful");
    } catch (\Exception $e) {
        return $this->fail([], "Login failed " . $e->getMessage());
    }
}
}
