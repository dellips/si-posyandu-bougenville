<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*public function index(){
        return view('login', [
            'title' => 'Login'
        ]);
    }*/
    public function showLoginForm(){
        return view('login');
    }

    public function login(Request $request){
        $credentials = $request->only('username', 'password');

        if(Auth::attempt($credentials)){
            // jika login berhasil maka ke dashboard
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'username' => 'Username atau password tidak sesuai',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();

        return redirect('/login');
    }
}
