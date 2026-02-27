<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserOtp;

class UserOTPRepository
{
    public function store($data){
        return UserOtp::create($data);
    }

    public function findAcualOtp($email, $otp_code){
        $user = User::where('email', $email)->first();
        if(!$user){
            return null;
        }
        return UserOtp::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function findOtp($user_id, $otp_code){
        $user = User::find($user_id);
        if(!$user){
            return null;
        }
        return UserOtp::where('user_id', $user->id)
            ->where('otp_code', $otp_code)
            ->first();
    }

    public function markOtpAsUsed($otpRecord){
        $otpRecord->is_used = true;
        $otpRecord->save();
    }
    public function markTemporaryTokenAsUsed($otpRecord){
        $otpRecord->temporary_token_used = true;
        $otpRecord->save();
    }

    public function findByTemporaryToken($temporary_token){
        return UserOtp::where('temporary_token', $temporary_token)->first();
    }

}
