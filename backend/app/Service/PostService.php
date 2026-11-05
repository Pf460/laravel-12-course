<?php

namespace App\Service;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Service\Interfaces\PostServiceInterface;
use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
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

    public function getByIdApi(int $id): ?Post
    {
        return Cache::remember("posts_{$id}", 60, function () use ($id) {
            return $this->postRepository->findApi($id);
        });
    }

    public function createApi(array $data): Post
    {
        $slug = Str::slug($data['title']);
        $data['slug'] = $slug;

        $post = $this->postRepository->createApi($data);

        $id = $post->id;

        Cache::forget('posts_all');

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

    public function deleteApi(int $id): bool
    {
        $post = $this->postRepository->findApi($id);
        if(!$post) {
            return false;
        }

        $deletedPost = $this->postRepository->deleteApi($post);

        Cache::forget('posts_all');
        Cache::forget("posts_{$id}");

        return $deletedPost;
    }
}
