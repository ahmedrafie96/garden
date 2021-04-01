<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class Gallery extends BaseModel
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['media'];
    public function media()
    {
        return $this->hasMany(Media::class);
    }
    public function cover_image()
    {
        return $this->belongsTo(Media::class, 'image_id');
    }
    public function scopeSearch($query, Request $request)
    {
    }
    public static $createRules = [
        'name' => 'nullable',
        'cover_image' => 'required|max:10000|mimes:png,jpg,gif',
    ];
    public static $updateRules = [
        'name' => 'nullable',
        'cover_image' => 'required|max:10000|mimes:png,jpg,gif',
    ];
}
