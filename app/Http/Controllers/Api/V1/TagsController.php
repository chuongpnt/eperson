<?php

namespace App\Http\Controllers\Api\V1;

use App\Engine\Models\Tag;
use App\Http\Controllers\Controller;
use App\Engine\Resources\Tag as TagResource;
use App\Engine\Requests\Admin\StoreTagsRequest;
use App\Engine\Requests\Admin\UpdateTagsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;



class TagsController extends Controller
{
    public function index()
    {
        

        return new TagResource(Tag::with([])->get());
    }

    public function show($id)
    {
        if (Gate::denies('tag_view')) {
            return abort(401);
        }

        $tag = Tag::with([])->findOrFail($id);

        return new TagResource($tag);
    }

    public function store(StoreTagsRequest $request)
    {
        if (Gate::denies('tag_create')) {
            return abort(401);
        }

        $tag = Tag::create($request->all());
        
        

        return (new TagResource($tag))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateTagsRequest $request, $id)
    {
        if (Gate::denies('tag_edit')) {
            return abort(401);
        }

        $tag = Tag::findOrFail($id);
        $tag->update($request->all());
        
        
        

        return (new TagResource($tag))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('tag_delete')) {
            return abort(401);
        }

        $tag = Tag::findOrFail($id);
        $tag->delete();

        return response(null, 204);
    }
}
