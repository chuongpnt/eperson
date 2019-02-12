<?php

namespace App\Http\Controllers\Api\V1;

use App\Engine\Models\Post;
use App\Http\Controllers\Controller;
use App\Engine\Resources\Post as PostResource;
use App\Engine\Requests\Admin\StorePostsRequest;
use App\Engine\Requests\Admin\UpdatePostsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Engine\Traits\FileUploadTrait;

class PostsController extends Controller
{
    public function index()
    {
        

        return new PostResource(Post::with(['category', 'user'])->get());
    }

    public function show($id)
    {
        if (Gate::denies('post_view')) {
            return abort(401);
        }

        $post = Post::with(['category', 'user'])->findOrFail($id);

        return new PostResource($post);
    }

    public function store(StorePostsRequest $request)
    {
        if (Gate::denies('post_create')) {
            return abort(401);
        }

        $request->request->add(['slug' => str_slug($request->get('title') , "-") ]);
        $post = Post::create($request->all());
        if ($request->hasFile('picture')) {
            $post->addMedia($request->file('picture'))->toMediaCollection('picture');
        }
        

        return (new PostResource($post))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdatePostsRequest $request, $id)
    {
        if (Gate::denies('post_edit')) {
            return abort(401);
        }


        $post = Post::findOrFail($id);
        $request->request->add(['slug' => $request->get('slug') ]);
        $post->update($request->all());
        if (! $request->input('picture') && $post->getFirstMedia('picture')) {
            $post->getFirstMedia('picture')->delete();
        }
        if ($request->hasFile('picture')) {
            $post->addMedia($request->file('picture'))->toMediaCollection('picture');
        }
        
        

        return (new PostResource($post))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('post_delete')) {
            return abort(401);
        }

        $post = Post::findOrFail($id);
        $post->delete();

        return response(null, 204);
    }
}
