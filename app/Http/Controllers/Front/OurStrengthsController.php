<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\MainController;
use App\Http\Resources\Page as PageResource;
use App\Engine\Models\Page;

class OurStrengthsController extends MainController
{
    public function index()
    {
        $data = new PageResource(Page::where('code', 'strength-of-us')->first());


        return view('scenes.ourstrengths', ['page' => $data->index()]);
    }
}
