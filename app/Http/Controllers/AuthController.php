<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }
    
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->route('home');
        }
 
        return back()->with('error', 'The provided credentials do not match our records.')->onlyInput('email');
    }
    
    public function registerPage()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $data= $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['created_at'] = now();
        $data['updated_at'] = now();

        DB::table('users')->insert($data);

        return to_route('login.index')->with('success', 'Your registration was successfull!');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login.index');
    }
}
