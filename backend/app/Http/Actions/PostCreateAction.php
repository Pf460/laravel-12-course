<?php

namespace App\Actions;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CreatePostAction
{
    public function handle(array $data, int $userId): Post
    {
        $data['slug'] = Str::slug($data['title']);
        $data['user_id'] = $userId;

        $post = Post::create($data);

        Cache::forget('posts_all_v2');

        return $post;
    }
}
