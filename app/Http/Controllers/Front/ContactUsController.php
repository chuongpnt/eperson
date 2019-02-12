<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\MainController;
use App\Http\Resources\Page as PageResource;
use App\Engine\Models\Page;

use App\Engine\Models\ContactUs;

class ContactUsController extends MainController
{
    public function index()
    {
        $data = new PageResource(Page::where('code', 'contact-us')->first());

        return view('scenes.contact', ['page' => $data->index()]);
    }

    public function register(Request $request)
    {
		try {
			$subscribe = ContactUs::create($request->all());
			return response()->json([
				'ok' => 1,
				'data' => [
					'message' => 'Insert successfully.'
				]
			]);
		} catch (\Exception $e) {
			return response()->json([
				'ok' => 1,
				'data' => [
					'errors' => 'Insert Unsuccessful.',
					'system_errors' => $e->getMessage()
				]
			]);
		}
    }

}
