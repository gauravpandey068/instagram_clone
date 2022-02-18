<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    //register new user
    public function registerView()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        //validate the form data
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|max:50|unique:users',
            'password' => 'required|min:6',
        ]);
        //create new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username'=> $request->username,
            'password' => bcrypt($request->password),
        ]);

        //attempt to login
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            $request->session()->regenerate();
            return redirect()->route('home');
        } else {
            return redirect()->back();
        }

    }

    //login user
    public function loginView()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        //validate the form data
        $credentials = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    //logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
