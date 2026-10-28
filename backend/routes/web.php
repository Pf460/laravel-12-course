<?php

use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\PostController as PublicPostController;
use Illuminate\Support\Facades\Route;

//действие контроллера передаётся массивом [Controller::class, 'method'].

Route::get('/', fn () => redirect()->route('blog.index')) -> name('index');

Route::prefix('admin')->as('admin.')->group(function () {
    Route::resource('posts', AdminPostController::class);
});

Route::prefix('blog')->as('blog.')->group(function () {
    Route::get('/', [PublicPostController::class, 'index'])->name('index');

    Route::get('/{post:slug}', [PublicPostController::class, 'show'])->name('show');
});
