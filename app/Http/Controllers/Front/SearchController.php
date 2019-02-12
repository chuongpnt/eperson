<?php
namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use App\Http\Controllers\MainController;
use App\Http\Resources\Page as PageResource;
use App\Engine\Models\Page;
use App\Http\Resources\Post as PostResource;
use App\Engine\Models\Post;

class SearchController extends MainController
{
    public function index(Request $request)
    {
        // $builder = Page::query();
        // $term = Request::all();
        // if(!empty($term['s'])){
            // $builder->where('code','like','%'.$term['s'].'%');
        // }
        // $result = $builder->orderBy('id')->get();

		$keyword = $request->query('s', '');
		$title_field = 'title';
		$content_field = 'content';
		$locale = app()->getLocale();
		
		if (config('app.locale_vi') != $locale) {
			$ret = new PostResource();
			$title_field = $ret->getField($title_field);
			$content_field = $ret->getField($content_field);
		}
		
		$result = new PostResource(
			Post::where($title_field,'like','%'.$keyword.'%')
				->where('is_homepage', '0')
				->orWhere($content_field,'like','%'.$keyword.'%')
				->where('is_homepage', '0')
                ->with('media')
				->get()
		);

		$page = new PageResource(Page::where('code', 'search')->first());
		
		return view('scenes.search', [
			'keyword' => $keyword,
			'data' => $result->index(),
			'page' => $page->index()
		]);

    }
}
