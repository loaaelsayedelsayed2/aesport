<?php

namespace App\Services;

use App\Http\Resources\UserProfileRequest;
use App\Http\Resources\UserProfileResources;
use App\Mail\ForgetPasswordMail;
use App\Repositories\UserOTPRepository;
use App\Repositories\UserRepository;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use SebastianBergmann\Type\TrueType;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthServices
{
    use ApiResponse;

    protected $userRepository, $userOTPRepository;
    public function __construct(
        UserRepository $userRepository,
        UserOTPRepository $userOTPRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userOTPRepository = $userOTPRepository;
    }
    public function register($request)
    {
        try {
            $password = Hash::make($request->password);
            $request->merge(['password' => $password]);
            $user = $this->userRepository->create($request->validated());
            return $this->success($user, "Registration successful , Go to login");
        } catch (\Exception $e) {
            return $this->fail([], "Registration failed . $e");
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
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return $this->success([], "Logout successful");
        } catch (\Exception $e) {
            return $this->fail([], "Logout failed " . $e->getMessage());
        }
    }

    public function showProfile()
    {
        try {
            $user = auth('api')->user();
            return $this->success(new UserProfileResources($user), "Profile retrieved successfully");
        } catch (\Exception $e) {
            return $this->fail([], "Failed to retrieve profile " . $e->getMessage());
        }
    }

    public function editProfile($request)
    {
        try {
            $user = auth('api')->user();
            $updatedUser = $this->userRepository->update($user->id, $request->validated());
            return $this->success(new UserProfileResources($updatedUser), "Profile updated successfully");
        } catch (\Exception $e) {
            return $this->fail([], "Failed to update profile " . $e->getMessage());
        }
    }

    public function changePassword($request)
    {
        try {
            $user = auth('api')->user();
            if (!Hash::check($request->current_password, $user->password)) {
                return $this->fail([], "Current password is incorrect");
            }
            $password = Hash::make($request->new_password);
            $data = $this->userRepository->updatePassword($user->id, $password);
            return $this->success(new UserProfileResources($data), "Password changed successfully");
        } catch (\Exception $e) {
            return $this->fail([], "Failed to change password " . $e->getMessage());
        }
    }

    public function forgetPassword($request)
    {
        try {
            $user = $this->userRepository->findByEmail($request->email);
            if (!$user) {
                return $this->fail([], "User not found");
            }
            $otp = rand(100000, 999999);
            Mail::to($user->email)->send(new ForgetPasswordMail($user, $otp));
            $data = [
                'user_id' => $user->id,
                'otp_code' => $otp,
                'expires_at' => now()->addMinutes(5),
                'is_used' => false,
            ];
            $this->userOTPRepository->store($data);
            return $this->success([], "check your email for otp code");
        } catch (\Exception $e) {
            return $this->fail([], "Failed to send password reset link " . $e->getMessage());
        }
    }

    public function verificationOtp($request)
    {
        try {
            $user = $this->userRepository->findByEmail($request->email);
            if (!$user) {
                return $this->fail([], "User not found");
            }
            $otpRecord = $this->userOTPRepository->findOtp($user->id, $request->otp_code);
            $acualRecord = $this->userOTPRepository->findAcualOtp($request->email, $request->otp_code);
            if (!$otpRecord || $acualRecord->otp_code != $request->otp_code) {
                return $this->notFound("Invalid OTP code");
            }
            if ($otpRecord->expires_at < now()) {
                return $this->fail([], "OTP code has expired");
            }
            if ($otpRecord->is_used == 1) {
                return $this->fail([], "OTP code has already been used");
            }
            $otpRecord->temporary_token = Str::random(60);
            $otpRecord->is_used = true;
            $otpRecord->save();
            return $this->success(['temporary_token' => $otpRecord->temporary_token], "OTP verified successfully, you can now reset your password");
        } catch (\Exception $e) {
            return $this->fail([], "Failed to verify OTP code " . $e->getMessage());
        }
    }

    public function resetPassword($request)
    {
        try {
            $otpRecord = $this->userOTPRepository->findByTemporaryToken($request->temporary_token);
            if (!$otpRecord) {
                return $this->notFound("Invalid temporary token");
            }
            if ($otpRecord->expires_at < now()) {
                return $this->fail([], "Temporary token has expired");
            }
            if ($otpRecord->temporary_token_used == 1) {
                return $this->fail([], "Temporary token has already been used");
            }
            $user = $otpRecord->user;
            $password = Hash::make($request->new_password);
            $this->userRepository->updatePassword($user->id, $password);
            $this->userOTPRepository->markTemporaryTokenAsUsed($otpRecord);
            return $this->success([], "Password reset successfully");
        } catch (\Exception $e) {
            return $this->fail([], "Failed to reset password " . $e->getMessage());
        }
    }
}
