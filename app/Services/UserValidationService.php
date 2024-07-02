<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserValidationService
{
    public function validateCreateUser($data)
    {
       
        $validator = Validator::make($data,[
            'name' => 'required|string|max:255',
            'email' => "required|string|max:255|unique:users",
            'password' => "required|string|min:8",
        ]);
        
        if($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function validateLoginUser($data)
    {
       
        $validator = Validator::make($data,[            
            'email' => "required|string|max:255|unique:users",
            'password' => "required|string|min:8",
        ]);
        
        if($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}