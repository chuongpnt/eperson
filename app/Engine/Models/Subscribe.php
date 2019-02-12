<?php

namespace App\Engine\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Subscribe extends Model
{
    public $table = "subscribe";

    protected $fillable = ['email'];


    public static function storeValidation($request)
    {
        return [
            'email' => 'max:191|required',
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'email' => 'max:191|required',
        ];
    }


}