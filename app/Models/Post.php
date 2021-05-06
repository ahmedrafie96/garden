<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Laratrust\Contracts\Ownable;

class Post extends BaseModel implements Ownable
{
    use HasFactory, HasTranslations;

    protected $guarded = [];
    protected $with = ['writer', 'category'];
    protected $appends = ['image', 'translations', 'headers'];
    protected $dateFormat = 'Y-m-d';
    public $translatable = ['title', 'content'];
    // protected $hidden = ['content']
    public function writer()
    {
        return $this->morphTo();
    }
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
    public function ownerKey($owner)
    {
        return $this->writer->id;
    }
    public static $createRules = [
        // 'title' => 'required',
        // 'content' => 'required',
        'category_id' => 'nullable',
        'gallery_id' => 'nullable',

    ];
    public static $updateRules = [
        // 'title' => 'nullable',
        // 'content' => 'nullable',
        'category_id' => 'nullable',
        'gallery_id' => 'nullable',

    ];
    public function scopeSearch($query, Request $request)
    {
    }
    public function getFieldsVisibilityAttribute()
    {
        return [
            'content' => false,
        ];
    }
    public function getImageAttribute()
    {
        return $this->gallery ? $this->gallery->cover_image : null;
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getHeadersAttribute()
    {
        return [
            'id',
            'category.name',
            'title',
            'writer.full_name',
            'created_at'
        ];
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }
}
