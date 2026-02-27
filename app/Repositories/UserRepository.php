<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function create($data){
        return User::updateOrCreate(['email' => $data['email']], $data);
    }
    public function findByEmail($email){
        return User::where('email', $email)->first();
    }
    public function findById($id){
        return User::find($id);
    }

    public function update($id, $data){
        $user = $this->findById($id);
        if($user){
            $user->update($data);
            return $user;
        }
        return null;
    }

    public function updatePassword($id, $password){
        $user = $this->findById($id);
        if($user){
            $user->password = $password;
            $user->save();
            return $user;
        }
        return null;
    }
}
