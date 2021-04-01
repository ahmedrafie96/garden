<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Laratrust\Contracts\Ownable;

class Post extends BaseModel implements Ownable
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['writer'];
    // protected $appends = ['fields_visibility'];
    protected $dateFormat = 'Y-m-d';
    
    // protected $hidden = ['content']
    public function writer()
    {
        return $this->morphTo();
    }
    public function ownerKey($owner)
    {
        return $this->writer->id;
    }
    public static $createRules = [
        'title' => 'required',
        'content' => 'required',
        'category_id' => 'nullable',
        'gallery_id' => 'nullable',

    ];
    public static $updateRules = [
        'title' => 'nullable',
        'content' => 'nullable',
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
}
