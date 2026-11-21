<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    
 public function loginPage() {
    return view('Account.login');
 }


 public function login(Request $request)
 {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/homepage');
        }

        return back()
            ->withErrors(['email' => 'Invalid email or password.'])
            ->onlyInput('email');
    }

 public function registerPage() {
    return view('Account.register');
 }
 public function register(Request $request) {
    $validate = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'unique:users'],
        'password' => ['required', 'confirmed', 'min:8'],
        ]);
 
    $user = User::create($validate);

        Auth::login($user);
        $request->session()->regenerate();
        return redirect('/homepage');

    }
}
