<?php
namespace App\Engine\Requests\Admin;

use App\Engine\Models\Page;
use Illuminate\Foundation\Http\FormRequest;

class StorePagesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Page::storeValidation($this);
    }
}
