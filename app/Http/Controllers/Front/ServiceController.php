<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\MainController;
use App\Http\Resources\Page as PageResource;
use App\Engine\Models\Page;
use App\Http\Resources\Post as PostResource;
use App\Engine\Models\Post;

class ServiceController extends MainController
{
    public function index()
    {
		$data = new PostResource(Post::with(['category'])->where('is_homepage', 0)->get());
		
        $page = new PageResource(Page::where('code', 'services')->first());

        return view('scenes.service', [
			'posts' => $data->index(),
			'page' => $page->index()
		]);
    }
	
	public function detail($slug)
	{
		$data = new PostResource(Post::where('slug', $slug)->first());
		
		$page = new PageResource(Page::where('code', 'services')->first());
		
		return view('scenes.service_detail', [
			'post' => $data->detail(),
			'page' => $page->index()
		]);
	}
}
