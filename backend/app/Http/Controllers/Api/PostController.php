<?php

namespace App\Http\Controllers\Api;

use App\Actions\CreatePostAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Service\Interfaces\PostServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function __construct(
        private PostServiceInterface $postService,
        private CreatePostAction $action
    ){}

    public function index(): PostCollection
    {
        $posts = $this->postService->getAllApi();

        return new PostCollection($posts);
    }

    public function getTrashed(): PostCollection
    {
        $posts = $this->postService->getTrashedApi();

        return new PostCollection($posts);
    }

    public function show(Post $post): PostResource | JsonResponse
    {
        $cachedPost = $this->postService->getByIdApi($post->id);
        return new PostResource($cachedPost);
    }

    public function store(StorePostRequest $request): PostResource
    {
        $post = $this->action->handle($request->validated(), auth()->id());

        return new PostResource($post);
    }

    public function update(UpdatePostRequest $request, Post $post): JsonResponse | PostResource
    {
        Gate::authorize('update', $post);

        $updatePost = $this->postService->updateApi($post, $request->validated());

        return new PostResource($updatePost);
    }

    public function destroy(Post $post): JsonResponse
    {
        Gate::authorize('delete', $post);

        $this->postService->softDeleteApi($post->id);

        return response()->json(['message' => 'Deleted']);
    }

    public function restore(int $id): JsonResponse
    {
        $result = $this->postService->restoreApi($id);

        if(!$result)
        {
            return response()->json(['success'=>false ,'message'=>'Пост не найден'], 404);
        }

        return response()->json(['success' => true]);
    }

    public function forceDelete(int $id): JsonResponse
    {
        $deleted = $this->postService->forceDeleteApi($id);

        if(!$deleted)
        {
            return response()->json(['success'=>false ,'message'=>'Пост не найден'], 404);
        }

        return response()->json(['success' => true]);
    }
}
