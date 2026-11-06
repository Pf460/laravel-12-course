<?php

namespace App\Service;

use App\Exceptions\ApiException;
use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Service\Interfaces\PostServiceInterface;
use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostService implements PostServiceInterface
{
    public function __construct(
        private PostRepositoryInterface $postRepository
    ){}

    public function getAllApi(): Collection
    {
        $posts = Cache::remember('posts_all', 60, function () {
            return $this->postRepository->allApi()->toArray();
        });

        return Post::hydrate($posts); //hydrate - метод который обратно возвращает массив из кэша
    }

    public function getTrashedApi(): Collection
    {
        $posts = Cache::remember('posts_trashed', 60, function () {
           return $this->postRepository->getTrashed()->toArray();
        });

        return Post::hydrate($posts);
    }

    public function getByIdApi(int $id): ?Post
    {
        $post = Cache::remember("posts_{$id}", 60, function () use ($id) {
            $data = $this->postRepository->findApi($id);
            return $data ? $data->toArray() : null;
        });

        if(!$post){
           throw new ApiException("Post with ID $id not found", 404);
        }

        return Post::hydrate([$post])->first();
    }

    public function createApi(array $data): Post
    {
        $slug = Str::slug($data['title']);
        $data['slug'] = $slug;

        $post = $this->postRepository->createApi($data);

        $id = $post->id;

        Log::info('Post created', [
            'post_id' => $id,
            'user_id' => $post->user_id
        ]);

        Cache::forget('posts_all');
        Cache::forget("posts_{$id}");

        return Cache::remember("posts_{$id}", 120, function () use ($id) {
            return $this->postRepository->findApi($id);
        });
    }

    public function updateApi($id, $data): ?Post
    {
        $post = $this->postRepository->findApi($id);

        $slug = Str::slug($data['title']);
        $data['slug'] = $slug;

        if(!$post) {
            return null;
        }

        $updatedPost = $this->postRepository->updateApi($post, $data);

        Cache::forget('posts_all');
        Cache::forget("posts_{$id}");

        return $updatedPost;
    }

    public function softDeleteApi(int $id): bool
    {
        $post = $this->postRepository->findApi($id);
        if(!$post) {
            return false;
        }

        $deletedPost = $this->postRepository->softDelete($post);

        Cache::forget('posts_all');
        Cache::forget("posts_{$id}");

        return $deletedPost;
    }

    public function restoreApi(int $id): ?Post
    {
        $post = $this->postRepository->restore($id);
        if(!$post) {
            return null;
        }

        Cache::forget('posts_all');
        Cache::forget("posts_{$id}");

        return $post;
    }

    public function forceDeleteApi(int $id): bool
    {
        $deleted = $this->postRepository->forceDelete($id);

        if(!$deleted)
        {
            return false;
        }

        Cache::forget('posts_all');
        Cache::forget("posts_{$id}");
        return true;
    }
}
