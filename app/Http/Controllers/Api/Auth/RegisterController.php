<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        $user = User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = auth()->guard('api')->login($user);
        return response()->json([
            'success' => true,
            'user'    => $user->only(['username', 'email']),
            'token'   => $token
        ], 201);
    }
}
