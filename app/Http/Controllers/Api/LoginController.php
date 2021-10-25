<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
            'role'     => 1,
        ];
        $result = [];
        if (!Auth::guard('admin')->attempt($credentials)) {
            $result = [
                'status' => 0,
                'msg'    => 'Login failed',
            ];
            return $result;
        }
        $user                 = Auth::guard('admin')->user();
        $user->remember_token = hash('sha256', Str::random(60));
        $user->last_login     = date('Y-m-d H:i:s');
        $user->save();
        return response()->json([
            'status' => 1,
            'msg'    => 'Login success',
            'result' => [
                'token' => $user->remember_token,
                'email' => $user->email,
            ],
        ]);
    }
}
