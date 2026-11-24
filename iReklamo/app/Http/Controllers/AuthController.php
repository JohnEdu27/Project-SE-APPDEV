<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
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

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Invalid email or password.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();
        $user = Auth::user();

        if (!$user->hasVerifiedEmail()) {
            return redirect()->route('verification.notice')
                ->with('status', 'verification-required');
        }
        if($user->role === 'official')
        {
            return redirect()->route('Official.dashboard')->with('success', 'Welcome back');
        }
        elseif($user->role === 'admin') {
            return redirect()->route('Admin.dashboard')->with('success', 'Welcome back');
        }else 
        return redirect()->route('homepage')->with('success', 'Welcome Back!');

    }

 public function registerPage() {
    return view('Account.register');
 }
 public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // Public registration always creates a normal gamer account.
        $user = User::create([
            ...$data,
            'role' => 'resident',
        ]);

        $user->sendEmailVerificationNotification();
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('verification.notice')
            ->with('success', 'Your Account has been Recorded, verification-link-sent');
    }

    public function Welcomepage() {
        return view('homepage');
    }


    public function displayForgotPass() {
        return view('Account.forgotpassword');
    }
    public function forgotPass(Request $request)
    {
        $request->validate(['email' => ['required', 'email']]);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function displayResetPass(Request $request, string $token)
    {
        return view('Account.resetpassword', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    public function resetPass(Request $request)
    {
        $credentials = $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $status = Password::reset($credentials, function (User $user, string $password) {
            $user->forceFill([
                'password' => $password,
                'remember_token' => Str::random(60),
            ])->save();

            event(new PasswordReset($user));
        });

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function adminPage() {
        return view('admin.dashboard');
    }
}

