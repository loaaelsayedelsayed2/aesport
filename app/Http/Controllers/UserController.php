<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UsereditRequest;
use App\Http\Requests\VerificationOtpRequest;
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
    public function logout()
    {
        return $this->authServices->logout();
    }
    public function showProfile()
    {
        return $this->authServices->showProfile();
    }
    public function editProfile(UsereditRequest $request)
    {
        return $this->authServices->editProfile($request);
    }
    public function changePassword(ChangePasswordRequest $request)
    {
        return $this->authServices->changePassword($request);
    }
    public function forgetPassword(ForgetPasswordRequest $request)
    {
        return $this->authServices->forgetPassword($request);
    }
    public function verificationOtp(VerificationOtpRequest $request)
    {
        return $this->authServices->verificationOtp($request);
    }
    public function resetPassword(ResetPasswordRequest $request)
    {
        return $this->authServices->resetPassword($request);
    }
}
