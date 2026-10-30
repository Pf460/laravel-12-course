<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct(
        private PostRepositoryInterface $posts
    ) {}

    public function index(Request $request) : View
    {
        $posts = $this->posts->getPublishedPaginated($request->get('q'), 4);
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post): View
    {
        $post = $this->posts->findPublishedBySlugOrFail($post->slug);
        return view('posts.show', compact('post'));
    }
}
