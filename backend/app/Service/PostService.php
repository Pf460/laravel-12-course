<?php

namespace App\Service;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Service\Interfaces\PostServiceInterface;
use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostService implements PostServiceInterface
{
    public function __construct(
        private PostRepositoryInterface $postRepository
    ){}

    public function getAllApi(): Collection
    {
        return $this->postRepository->allApi();
    }
    public function getByIdApi(int $id): ?Post
    {
        return $this->postRepository->findApi($id);
    }

    public function createApi(array $data): Post
    {
        $slug = Str::slug($data['title']);
        $data['slug'] = $slug;

        return $this->postRepository->createApi($data);
    }

    public function updateApi($id, $data): ?Post
    {
        $post = $this->postRepository->findApi($id);

        $slug = Str::slug($data['title']);
        $data['slug'] = $slug;

        if(!$post) {
            return null;
        }

        return $this->postRepository->updateApi($post, $data);
    }

    public function deleteApi(int $id): bool
    {
        $post = $this->postRepository->findApi($id);
        if(!$post) {
            return false;
        }

        return $this->postRepository->deleteApi($post);
    }

}
