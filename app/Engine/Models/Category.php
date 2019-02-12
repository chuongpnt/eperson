<?php
namespace App\Engine\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Class Category
 *
 * @package App
 * @property string $title
 * @property text $summary
 * @property string $logo
 * @property tinyInteger $is_enable
 * @property string $parent
*/
class Category extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    
    protected $fillable = ['title', 'summary', 'is_enable', 'parent_id' , 'title_jp','summary_jp','slug'];
    protected $appends = ['logo', 'logo_link'];
    protected $with = ['media'];
    

    public static function storeValidation($request)
    {
        return [
            'title' => 'max:191|required',
            'summary' => 'max:65535|nullable',
            'title_jp' => 'max:191|required',
            'summary_jp' => 'max:65535|nullable',
            'logo' => 'file|image|nullable',
            'is_enable' => 'boolean|nullable',
            'parent_id' => 'integer|exists:categories,id|max:4294967295|nullable'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'max:191|required',
            'summary' => 'max:65535|nullable',
            'title_jp' => 'max:191|required',
            'summary_jp' => 'max:65535|nullable',
            'logo' => 'nullable',
            'is_enable' => 'boolean|nullable',
            'parent_id' => 'integer|exists:categories,id|max:4294967295|nullable'
        ];
    }

    

    public function getLogoAttribute()
    {
        return $this->getFirstMedia('logo');
    }

    /**
     * @return string
     */
    public function getLogoLinkAttribute()
    {
        $file = $this->getFirstMedia('logo');
        if (! $file) {
            return null;
        }

        return '<a href="' . $file->getUrl() . '" target="_blank">' . $file->file_name . '</a>';
    }
    
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id')->withTrashed();
    }
    
    
}
