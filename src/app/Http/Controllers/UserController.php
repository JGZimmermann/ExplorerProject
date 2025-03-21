<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string',
            'password'=>'required'
        ]);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);
        return "Usuário ". $user->name ." Criado!";
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
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
