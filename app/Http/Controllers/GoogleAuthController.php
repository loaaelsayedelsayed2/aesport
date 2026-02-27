<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginGoogleRequest;
use App\Models\User;
use App\Services\AuthGoogleServices;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;


class GoogleAuthController extends Controller
{
    protected $authGoogleServices;
    public function __construct(AuthGoogleServices $authGoogleServices)
    {
        $this->authGoogleServices = $authGoogleServices;
    }

    public function loginWithGoogle(LoginGoogleRequest $request)
    {
        return $this->authGoogleServices->loginWithGoogle($request);
    }
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

}
