<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

final class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        $token = $user->createToken();

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email|exists:users",
            "password" => "required",
        ]);
        $user = User::where("email", $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(["message"=> "The prevoided credintials are incorrect"],401);
        }
        $token = $user->createToken();
        return [
            "user" => $user,
            "token" => $token
        ];
    }
}
