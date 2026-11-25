<?php
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidentsController;
use App\Http\Controllers\OfficialsController;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', [AuthController::class, 'Welcomepage']);

Route::middleware('guest')->group(function () {

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit')->middleware('throttle:5,1');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('Register.submit');
Route::get('/forgotpassword', [AuthController::class, 'displayForgotPass'])->name('password.request');
Route::post('/forgotpassword', [AuthController::class, 'forgotPass'])->name('password.email')->middleware('throttle:5,1');
Route::get('/reset-password/{token}', [AuthController::class, 'displayResetPass'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPass'])->name('password.update');
});


Route::get('/email/verify', fn () => view('Account.verify'))->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('homepage')->with('status', 'email-verified');
})->middleware(['auth', 'signed', 'throttle:6,1'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    if ($request->user()->hasVerifiedEmail()) {
        return redirect()->route('homepage');
    }

    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');



Route::middleware('auth', 'verified')->group(function() {
Route::get('/homepage', [ResidentsController::class, 'homepage'])->name('homepage');
Route::post('/logout', [ResidentsController::class, 'logout'])->name('logout');
Route::get('/submit-complaint', [ResidentsController::class, 'showSubmit'])->name('submit.complaint');
Route::post('/submit-complaint', [ComplaintController::class, 'store'])->name('complaints.store');
Route::get('/my-complaints', [ComplaintController::class, 'indexREQ'])->name('my.complaints');
});

Route::middleware('auth', 'verified', 'role:official')->prefix('official')->group(function () {

Route::get('/complaints', [ComplaintController::class, 'index']);
Route::get('/complaints/{complaint}', [ComplaintController::class, 'show']);
Route::patch('/complaints/{complaint}', [ComplaintController::class, 'update']);
Route::get('/stats', [ComplaintController::class, 'stats']);
Route::post('/retrain', [ComplaintController::class, 'retrain']);
Route::get('/dashboard', [OfficialsController::class, 'index'])->name('official.dashboard');
Route::patch('/complaints/{complaint}/status', [OfficialsController::class, 'updateStatus'])->name('official.complaints.status');


});
Route::middleware('auth', 'verified', 'role:admin')->prefix('admin')->group(function () {
Route::get('/dashboard', [AuthController::class, 'adminPage'])->name('Admin.dashboard');


});



