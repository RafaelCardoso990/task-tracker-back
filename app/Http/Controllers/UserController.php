<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Services\UserValidationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    protected $userRepository;
    protected $userValidationService;

    public function __construct(UserRepository $userRepository, UserValidationService $userValidationService)
    {
        $this->userRepository = $userRepository;
        $this->userValidationService = $userValidationService;
    }


    public function createUser(Request $request)
    {
        try {

            $this->userValidationService->validateCreateUser($request->all());
            $user = $this->userRepository->createUser([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);            
            return response()->json(["message" => "Cadastro realizado com sucesso!"], 201);

        } catch (ValidationException $e) {
           
            return response()->json(['error' => $e->errors()], 422);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao processar a requisição.'], 500);
        }
    }

    public function loginUser(Request $request)
    {
        
        try {        
            $credentials = $request->only('email', 'password');
    
            $user = $this->userRepository->findByEmail(['email' => $request->email]);          
    
            $passwordChecked = $this->userRepository->verifyPassword($user, $credentials['password']);          
         
            if (!$passwordChecked) {
                return response()->json(['error' => 'Credenciais inválidas'], 401);
            }
        
            return response()->json(201);
        
        } catch (ValidationException $e) {
            
            return response()->json(['error' => $e->errors()], 422);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao processar a requisição.'], 500);
        }
    }
}
