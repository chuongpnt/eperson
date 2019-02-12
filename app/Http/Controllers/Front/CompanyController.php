<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\MainController;
use App\Http\Resources\Page as PageResource;
use App\Engine\Models\Page;

class CompanyController extends MainController
{
    public function index()
	{
        $data = new PageResource(Page::where('code', 'about-us')->first());

        return view('scenes.company', ['page' => $data->index()]);
	}
}
