<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Media extends BaseModel
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = ['path'];
    protected $appends = ['url'];
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
    public function scopeSearch($query, Request $request)
    {
    }
    public static $createRules = [
        'file' => 'required|max:10000|mimes:png,jpg,gif',
        'gallery_id' => 'sometimes|exists:galleries,id'
    ];
    public static $updateRules = [
        'file' => 'required|max:10000|mimes:png,jpg,gif',
        'gallery_id' => 'sometimes|exists:galleries,id'
    ];
    public function getUrlAttribute()
    {
        return Storage::url($this->path);
    }
}
