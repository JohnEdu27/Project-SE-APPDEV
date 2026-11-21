<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidentsController;
use App\Http\Controllers\OfficialsController;
use Illuminate\Foundation\Configuration\Middleware;



Route::middleware('guest')->group(function () {
Route::get('/', [AuthController::class, 'WelcomePage']);
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('Register.submit');
});

Route::middleware('auth', 'verified')->group(function() {
Route::get('/', function() {return redirect('/homepage');});
Route::get('/login', function() {return redirect('/homepage');});
Route::get('/register', function() {return redirect('/homepage');});
Route::get('/homepage', [ResidentsController::class, 'homepage'])->name('homepage');
Route::post('/logout', [ResidentsController::class, 'logout'])->name('logout');
});