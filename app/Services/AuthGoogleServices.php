<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;



class AuthGoogleServices
{
    use ApiResponse;
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }



    public function loginWithGoogle($request)
    {

        try {
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->userFromToken($request->id_token);

            $firstName = $googleUser->user['given_name'] ?? '';
            $lastName  = $googleUser->user['family_name'] ?? '';

            $user = $this->userRepository->findByEmail($googleUser->getEmail());

            if (!$user) {
                $user = $this->userRepository->create([
                    'fname' => $firstName,
                    'lname' => $lastName,
                    'email' => $googleUser->getEmail(),
                    'phone' => '0000000000',
                    'password' => Hash::make(123456789),
                    'image' => $googleUser->getAvatar(),
                    'role' => 'user',
                    'email_verified_at' => now()
                ]);
            } else {
                $user->update([
                    'image' => $googleUser->getAvatar()
                ]);
            }

            $token = auth('api')->login($user);

            $data = [
                'status' => true,
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ];
            return $this->success($data, "Login with Google successful");
        } catch (\Exception $e) {
            return $this->fail([], "Login with Google failed: " . $e->getMessage());
        }
    }
}
