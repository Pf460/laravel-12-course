<?php

use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PostController as PublicPostController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

//действие контроллера передаётся массивом [Controller::class, 'method'].

Route::get('/', fn () => redirect()->route('blog.index')) -> name('index');

Route::prefix('admin')->as('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('posts', AdminPostController::class);
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::patch('users/{userId}/role', [UserController::class, 'updateRole'])->name('users.update.role');
});

Route::prefix('blog')->as('blog.')->group(function () {
    Route::get('/', [PublicPostController::class, 'index'])->name('index');

    Route::get('/{post:slug}', [PublicPostController::class, 'show'])->name('show');
});

Route::middleware('guest')->group(function () {
   Route::get('/login', [AuthController::class, 'loginShow'])->name('login');
   Route::post('/login', [AuthController::class, 'login'])->name('login.post');

   Route::get('/signup', [AuthController::class, 'signupShow'])->name('signup');
   Route::post('/signup', [AuthController::class, 'signup'])->name('signup.post');

   Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.request');
   Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
   Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
   Route::post('reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');

});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('email/verify/', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/');
    })->name('verification.verify');

    Route::post('/email/verification-notification', function (\Illuminate\Http\Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Ссылка для подтверждения отправлена');
    })->name('verification.send');

    Route::middleware('verified')->group(function () {
       Route::get('admin/', function() {
           return 'Админка';
       });
    });
});
