<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\MainController;
use App\Http\Resources\Article as ArticleResource;
use App\Engine\Models\Article;
use App\Http\Resources\Page as PageResource;
use App\Engine\Models\Page;
use App\Http\Resources\Post as PostResource;
use App\Engine\Models\Post;

class HomeController extends MainController
{
    public function index()
	{

        $datas = new PostResource(Post::where('is_homepage', '1')->with('media')->get());
      
        return view('scenes.home', ['posts' => $datas->index()]);


		//$data = new ArticleResource(Article::with('category')->take(4)->get());
		
		//return view('scenes.home', ['articles' => $data->index()]);
	}
}
