<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\AuthResource;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect'],
            ]);
        }

        return $this->makeToeken($user);
    }
    
    public function register(RegisterRequest $request){
            
        $user = User::create($request->validated());

        return $this->makeToeken($user);
        
        
    }

    public function makeToeken($user){
        $token = $user->createToken('myToken')->plainTextToken;

        return AuthResource::make([
            'token' => $token,
                'user' => [
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }
}
