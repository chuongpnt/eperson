<?php

namespace App\Http\Controllers\Api\V1;

use App\Engine\Models\UserAction;
use App\Engine\Resources\UserAction as UserActionResource;
use App\Http\Controllers\Controller;

class UserActionsController extends Controller
{

    /**
     * Display a listing of UserAction.
     *
     * @return UserActionResource
     */
    public function index()
    {
        return new UserActionResource(UserAction::with(['user'])->get());
    }
}
