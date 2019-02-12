<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\MainController;
use Illuminate\Http\Response;

use App\Engine\Models\Subscribe;

class SubscribeController extends MainController
{
    public function index()
    {
        return view('', []);
    }

    public function register(Request $request)
    {
		try {
			$subscribe = Subscribe::create($request->all());
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
