<?php

namespace App\Http\Controllers\Api\V1;

use App\Engine\Models\Category;
use App\Http\Controllers\Controller;
use App\Engine\Resources\Category as CategoryResource;
use App\Engine\Requests\Admin\StoreCategoriesRequest;
use App\Engine\Requests\Admin\UpdateCategoriesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Engine\Traits\FileUploadTrait;


class CategoriesController extends Controller
{
    public function index()
    {
        

        return new CategoryResource(Category::with(['parent'])->get());
    }

    public function show($id)
    {
        if (Gate::denies('category_view')) {
            return abort(401);
        }

        $category = Category::with(['parent'])->findOrFail($id);

        return new CategoryResource($category);
    }

    public function store(StoreCategoriesRequest $request)
    {

        if (Gate::denies('category_create')) {
            return abort(401);
        }

        $request->request->add(['slug' => str_slug($request->get('title') , "-") ]);

        $category = Category::create($request->all());
        
        if ($request->hasFile('logo')) {
            $category->addMedia($request->file('logo'))->toMediaCollection('logo');
        }

        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateCategoriesRequest $request, $id)
    {
        if (Gate::denies('category_edit')) {
            return abort(401);
        }

        $category = Category::findOrFail($id);
        $category->update($request->all());
        
        if (! $request->input('logo') && $category->getFirstMedia('logo')) {
            $category->getFirstMedia('logo')->delete();
        }
        if ($request->hasFile('logo')) {
            $category->addMedia($request->file('logo'))->toMediaCollection('logo');
        }

        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('category_delete')) {
            return abort(401);
        }

        $category = Category::findOrFail($id);
        $category->delete();

        return response(null, 204);
    }
}
