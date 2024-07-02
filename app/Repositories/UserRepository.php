<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class userRepository
{
    public function createUser(array $userData)
    {
        return User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['name'])
        ]);

    }

    public function findByEmail(array $userData)     
    {               
        return User::where('email', $userData['email'])->first();
    }

    public function verifyPassword(User $user, $password)
    {        
        $crendetialsPassword = $password;
        $hashedPassword = $user['password'];
        
        $result = Hash::check( $crendetialsPassword, $hashedPassword);
        var_dump($result);
        return $result;
    }
}