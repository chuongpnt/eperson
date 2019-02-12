<?php
namespace App\Engine\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tag
 *
 * @package App
 * @property string $name
 * @property tinyInteger $recommend
 * @property tinyInteger $hot
 * @property tinyInteger $new
*/
class Tag extends Model
{
    use SoftDeletes;

    
    protected $fillable = ['name', 'recommend', 'hot', 'new'];
    

    public static function storeValidation($request)
    {
        return [
            'name' => 'max:191|required',
            'recommend' => 'boolean|nullable',
            'hot' => 'boolean|nullable',
            'new' => 'boolean|nullable'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'name' => 'max:191|required',
            'recommend' => 'boolean|nullable',
            'hot' => 'boolean|nullable',
            'new' => 'boolean|nullable'
        ];
    }

    

    
    
    
}
