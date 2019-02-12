<?php

namespace App\Http\Controllers\Api\V1;

use App\Engine\Models\ContactUs;
use App\Http\Controllers\Controller;
use App\Engine\Resources\ContactUs as ContactUsResource;
use App\Engine\Requests\Admin\StorePagesRequest;
use App\Engine\Requests\Admin\UpdatePagesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Engine\Traits\FileUploadTrait;

class RegistersController extends Controller
{
    public function index()
    {
        

       return new ContactUsResource(ContactUs::with([])->where('is_contact', '=', 0)->get());
    }

    public function show($id)
    {
        if (Gate::denies('page_view')) {
            return abort(401);
        }

        $page = ContactUs::with([])->findOrFail($id);

        return new ContactUsResource($page);
    }





}
