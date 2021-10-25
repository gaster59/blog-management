<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function LoginController()
    {

    }

    public function index()
    {
        return view('admin.login');
    }

    public function doLogin(Request $request)
    {
        $email       = $request->input('email', '');
        $password    = $request->input('password', '');
        $credentials = [
            'email'    => $email,
            'password' => $password,
            'role'     => 1,
        ];
        if (!Auth::guard('admin')->attempt($credentials)) {
            return redirect()->back()->withInput()->with('error', 'Login failed');
        }
        $user                 = Auth::guard('admin')->user();
        $user->remember_token = hash('sha256', Str::random(60));
        $user->last_login     = date('Y-m-d H:i:s');
        $user->save();
        return redirect()->route('admin.dashboard.index');

        // $nameToken = config('constants.access_token');
        // $token = $user->createToken($nameToken)->accessToken;
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.index');
    }

    // public function temp(Faker $faker)
    // {

    //     for ($i = 0; $i < 10; $i++) {

    //         $user = new User();
    //         $user->name = $faker->name;
    //         $user->role = rand(1,2);
    //         $user->email = $faker->unique()->email;
    //         $user->password = bcrypt('123123');
    //         $user->mobile = $faker->numerify('###-###-####');
    //         $user->profile = $faker->text();
    //         $user->save();
    //     }
    // }
}
