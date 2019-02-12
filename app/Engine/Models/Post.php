<?php
namespace App\Engine\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
/**
 * Class Post
 *
 * @package App
 * @property string $title
 * @property text $summary
 * @property text $content
 * @property integer $rating
 * @property integer $viewer
 * @property enum $stage
 * @property string $category
 * @property string $user
*/
class Post extends Model implements HasMedia
{
    use SoftDeletes , HasMediaTrait;

    
    protected $fillable = ['title', 'summary', 'is_homepage', 'content', 'rating', 'viewer', 'stage', 'category_id', 'user_id','title_jp', 'summary_jp', 'content_jp','slug'];
    protected $appends = ['picture', 'picture_link'];
    protected $with = ['media'];

    public static $enum_stage = ["Locked" => "Locked", "Released" => "Released", "Blocked" => "Blocked"];

    public static function storeValidation($request)
    {
        return [
            'title' => 'max:191|required',
            'summary' => 'max:65535|nullable',
            'content' => 'max:65535|nullable',
            'title_jp' => 'max:191|required',
            'summary_jp' => 'max:65535|nullable',
            'content_jp' => 'max:65535|nullable',
            'picture' => 'file|image|nullable',
            'rating' => 'integer|max:4294967295|nullable',
            'viewer' => 'integer|max:4294967295|nullable',
            'stage' => 'in:Locked,Released,Blocked|nullable',
            'category_id' => 'integer|exists:categories,id|max:4294967295|nullable',
            'is_homepage' => 'boolean|nullable',
            'user_id' => 'integer|exists:users,id|max:4294967295|nullable'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'max:191|required',
            'summary' => 'max:65535|nullable',
            'content' => 'max:65535|nullable',
            'title_jp' => 'max:191|required',
            'summary_jp' => 'max:65535|nullable',
            'content_jp' => 'max:65535|nullable',
            'picture' => 'nullable',
            'rating' => 'integer|max:4294967295|nullable',
            'viewer' => 'integer|max:4294967295|nullable',
            'stage' => 'in:Locked,Released,Blocked|nullable',
            'is_homepage' => 'boolean|nullable',
            'category_id' => 'integer|exists:categories,id|max:4294967295|nullable',
            'user_id' => 'integer|exists:users,id|max:4294967295|nullable'
        ];
    }

    

    
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withTrashed();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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
