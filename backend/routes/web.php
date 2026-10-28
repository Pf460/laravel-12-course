<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

//действие контроллера передаётся массивом [Controller::class, 'method'].
//Route::get('/', [PostController::class, 'index'])->name('posts.index');
//Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::resource('posts', PostController::class);
