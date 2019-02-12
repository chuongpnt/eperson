<?php

namespace App\Http\Controllers\Api\V1;

use App\Engine\Models\Page;
use App\Http\Controllers\Controller;
use App\Engine\Resources\Page as PageResource;
use App\Engine\Requests\Admin\StorePagesRequest;
use App\Engine\Requests\Admin\UpdatePagesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Engine\Traits\FileUploadTrait;

class PagesController extends Controller
{
    public function index()
    {
        

        return new PageResource(Page::with([])->get());
    }

    public function show($id)
    {
        if (Gate::denies('page_view')) {
            return abort(401);
        }

        $page = Page::with([])->findOrFail($id);

        return new PageResource($page);
    }

    public function store(StorePagesRequest $request)
    {
        if (Gate::denies('page_create')) {
            return abort(401);
        }


        $page = Page::create($request->all());
        if ($request->hasFile('picture')) {
            $page->addMedia($request->file('picture'))->toMediaCollection('picture');
        }
        

        return (new PageResource($page))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdatePagesRequest $request, $id)
    {
        if (Gate::denies('page_edit')) {
            return abort(401);
        }


        $page = Page::findOrFail($id);
        $page->update($request->all());

        if (! $request->input('picture') && $page->getFirstMedia('picture')) {
            $page->getFirstMedia('picture')->delete();
        }
        if ($request->hasFile('picture')) {
            $page->addMedia($request->file('picture'))->toMediaCollection('picture');
        }
        

        return (new PageResource($page))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('page_delete')) {
            return abort(401);
        }

        $page = Page::findOrFail($id);
        $page->delete();

        return response(null, 204);
    }
}
