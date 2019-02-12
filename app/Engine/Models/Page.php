<?php
namespace App\Engine\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Class Page
 *
 * @package App
 * @property string $title
 * @property string $title_jp
 * @property string $description
 * @property string $description_jp
 * @property text $content
 * @property text $content_jp
 * @property string $slug
 * @property string $stage
 * @property string $keyword
*/
class Page extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    
    protected $fillable = ['title', 'title_jp', 'description', 'description_jp', 'content', 'content_jp', 'code', 'keyword','name', 'keyword_jp','name_jp'];
    protected $appends = ['picture', 'picture_link'];
    protected $with = ['media'];

    public static $enum_stage = ["Locked" => "Locked", "Released" => "Released", "Blocked" => "Blocked"];

    public static function storeValidation($request)
    {
        return [
            'title' => 'max:191|nullable',
            'title_jp' => 'max:191|nullable',
            'description' => 'max:191|nullable',
            'description_jp' => 'max:191|nullable',
            'content' => 'max:65535|nullable',
            'content_jp' => 'max:65535|nullable',
            'code' => 'max:191|nullable',
            'name' => 'max:65535|nullable',
            'keyword' => 'max:65535|nullable',
            'name_jp' => 'max:65535|nullable',
            'keyword_jp' => 'max:65535|nullable'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'max:191|nullable',
            'title_jp' => 'max:191|nullable',
            'description' => 'max:191|nullable',
            'description_jp' => 'max:191|nullable',
            'content' => 'max:65535|nullable',
            'content_jp' => 'max:65535|nullable',
            'code' => 'max:191|nullable',
            'name' => 'max:65535|nullable',
            'keyword' => 'max:65535|nullable',
            'name_jp' => 'max:65535|nullable',
            'keyword_jp' => 'max:65535|nullable'
        ];
    }

    public function getPictureAttribute()
    {
        return $this->getFirstMedia('picture');
    }

    /**
     * @return string
     */
    public function getPictureLinkAttribute()
    {
        $file = $this->getFirstMedia('picture');
        if (! $file) {
            return null;
        }

        return '<a href="' . $file->getUrl() . '" target="_blank">' . $file->file_name . '</a>';
    }
    

    
    
    
}
