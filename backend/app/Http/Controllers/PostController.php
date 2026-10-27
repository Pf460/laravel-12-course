<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index() : View
    {
        //$posts - получение всех опубликованных постов

        $posts = Post::query() //query - помогает нам использовать методы
            ->where('is_published', true) //что именно показываем
            ->orderByDesc('published_at') //сортировка
            ->paginate(6); //сколько вывод

        return view('posts.index', compact('posts')); //возвращаем во view весь наш posts - первая переменная название файла показа, вторая что возвращаем
    }

    //show - для просмотра конкретного поста
    public function show(Post $post) : View
    {
        return view('posts.show', compact('post'));
    }
}
