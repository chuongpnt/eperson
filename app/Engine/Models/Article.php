<?php
namespace App\Engine\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Class Article
 *
 * @package App
 * @property string $title
 * @property text $summary
 * @property text $content
 * @property string $picture
 * @property enum $stage
 * @property string $category
 * @property string $user
*/
class Article extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    
    protected $fillable = ['title', 'summary', 'content', 'stage', 'category_id', 'user_id','title_jp', 'summary_jp', 'content_jp','slug'];
    protected $appends = ['picture', 'picture_link'];
    protected $with = ['media'];
    

    public static $enum_stage = ["Locked" => "Locked", "Released" => "Released", "Blocked" => "Blocked"];

    public static function storeValidation($request)
    {
        return [
            'title' => 'max:191|required',
            'summary' => 'max:65535|nullable',
            'content' => 'max:65535|nullable',
            'picture' => 'file|image|nullable',
            'stage' => 'in:Locked,Released,Blocked|nullable',
            'category_id' => 'integer|exists:categories,id|max:4294967295|nullable',
            'user_id' => 'integer|exists:users,id|max:4294967295|nullable',
            'tags' => 'array|nullable',
            'tags.*' => 'integer|exists:tags,id|max:4294967295|nullable'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'max:191|required',
            'summary' => 'max:65535|nullable',
            'content' => 'max:65535|nullable',
            'picture' => 'nullable',
            'stage' => 'in:Locked,Released,Blocked|nullable',
            'category_id' => 'integer|exists:categories,id|max:4294967295|nullable',
            'user_id' => 'integer|exists:users,id|max:4294967295|nullable',
            'tags' => 'array|nullable',
            'tags.*' => 'integer|exists:tags,id|max:4294967295|nullable'
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
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withTrashed();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag')->withTrashed();
    }
    
    
}
