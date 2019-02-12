<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\MainController;
use App\Http\Resources\Post as PostResource;
use App\Engine\Models\Post;

class BlogController extends MainController
{
    public function index()
	{
		$data = new PostResource(Post::with(['category'])->get());
		
		return view('scenes.blog', ['posts' => $data->index()]);
	}
	
	public function detail($slug)
	{
		$data = new PostResource(Post::where('slug', $slug)->first());
		
		$page = new PostResource(Post::with(['category'])->get());
		
		return view('scenes.blog_detail', [
			'post' => $data->detail(),
			'page' => $page->index()
		]);
	}
}
