<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);
        return "Usuário ". $user->name ." Criado!";
    }

    public function login(LoginUserRequest $request)
    {
        $validated = $request->validated();
        $user = User::where('email', $validated['email'])->first();
        if(!$user || !Hash::check($validated['password'], $user->password)){
            return "Credenciais invalidas";
        } else {
            return $user->createToken($user->name.'-AuthToken')->plainTextToken;
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return "Usuário deslogado!";
    }
}
