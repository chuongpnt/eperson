<?php

namespace App\Engine\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ContactUs extends Model
{
    public $table = "contact_us";

    protected $fillable = ['name', 'email','company_name','subject','content','phone','address','is_contact'];


    public static function storeValidation($request)
    {
        return [
            'name' => 'max:191|required',
            'email' => 'max:191|required',
            'company_name' => 'max:191|nullable',
            'subject' => 'max:191|nullable',
            'content' => 'max:65535|nullable',
            'phone' => 'max:65535|nullable',
            'address' => 'max:65535|nullable',

        ];
    }

    public static function updateValidation($request)
    {
        return [
            'name' => 'max:191|required',
            'email' => 'max:191|required',
            'company_name' => 'max:191|nullable',
            'subject' => 'max:191|nullable',
            'content' => 'max:191|nullable',
            'phone' => 'max:191|nullable',
            'address' => 'max:65535|nullable',
        ];
    }


}
