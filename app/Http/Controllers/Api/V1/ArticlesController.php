<?php

namespace App\Http\Controllers\Api\V1;

use App\Engine\Models\Article;
use App\Http\Controllers\Controller;
use App\Engine\Resources\Article as ArticleResource;
use App\Engine\Requests\Admin\StoreArticlesRequest;
use App\Engine\Requests\Admin\UpdateArticlesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Engine\Traits\FileUploadTrait;


class ArticlesController extends Controller
{
    public function index()
    {
        

        return new ArticleResource(Article::with(['category', 'user', 'tags'])->get());
    }

    public function show($id)
    {
        if (Gate::denies('article_view')) {
            return abort(401);
        }

        $article = Article::with(['category', 'user', 'tags'])->findOrFail($id);

        return new ArticleResource($article);
    }

    public function store(StoreArticlesRequest $request)
    {
        if (Gate::denies('article_create')) {
            return abort(401);
        }

        $request->request->add(['slug' => str_slug($request->get('title') , "-") ]);
        $article = Article::create($request->all());
        $article->tags()->sync($request->input('tags', []));
        if ($request->hasFile('picture')) {
            $article->addMedia($request->file('picture'))->toMediaCollection('picture');
        }

        return (new ArticleResource($article))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateArticlesRequest $request, $id)
    {
        if (Gate::denies('article_edit')) {
            return abort(401);
        }

        $article = Article::findOrFail($id);
        $request->request->add(['slug' => $request->get('slug') ]);
        $article->update($request->all());
        $article->tags()->sync($request->input('tags', []));
        if (! $request->input('picture') && $article->getFirstMedia('picture')) {
            $article->getFirstMedia('picture')->delete();
        }
        if ($request->hasFile('picture')) {
            $article->addMedia($request->file('picture'))->toMediaCollection('picture');
        }

        return (new ArticleResource($article))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('article_delete')) {
            return abort(401);
        }

        $article = Article::findOrFail($id);
        $article->delete();

        return response(null, 204);
    }
}
