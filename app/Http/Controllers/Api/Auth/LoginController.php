<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->guard('api')->attempt($credentials)) {

            return response()->json([
                'success' => false,
                'message' => 'Email or Password is incorrect'
            ], 400);
        }
        return response()->json([
            'success'       => true,
            'user'          => auth()->guard('api')->user()->only(['name', 'email']),
            'token'         => $token
        ], 200);
    }
}
