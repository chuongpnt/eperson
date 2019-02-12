<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\MainController;
use App\Http\Resources\Post as PostResource;
use App\Engine\Models\Post;

class AboutUsController extends MainController
{
    public function index()
	{
		$data = new PostResource(Post::where('slug', 'about-us')->first());
		
		return view('scenes.about', ['datas' => $data->detail()]);
	}
}
