<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function viewLogin() {
        return view('login');
    }

    public function viewRegister() {
        return view('register');
    }

    public function postLogin(Request $request) {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {
            return redirect()->route('home')->with('success', 'You have Been Logged in Successfully');
        }

        return redirect()->route('login')->with('success', 'Invalide email/password');

    }

    public function postRegister(Request $request) {

        $request->validate([
            'name' => 'required|min:6|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make( $request->password );
        $user->save();

        return redirect()->route('login');

    }


    public function logout() {
        Session::flush();
        Auth::logout();

        return redirect()->route('home');
    }
}
