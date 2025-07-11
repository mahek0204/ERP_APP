<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
//use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller 
{


    public function __construct()
    {
        // Apply middleware to specific actions
        $this->middleware('guest')->except(['home', 'logout']);
        $this->middleware('auth')->only(['home', 'logout']);
    }

    public function register(): View
    {
        return view('auth.register');
    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|string|email:rfc,dns|max:250|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = user::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('home')
            ->withSuccess('You have successfully registered & logged in!');
    }

    public function login(): View
    {
        return view('auth.login');
        
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');

    }

    public function home(): View
    {
        return view('auth.home');
    } 
    
    function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    
}
