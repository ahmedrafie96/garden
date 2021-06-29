<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class Category extends BaseModel
{
    protected $guarded = [];
    // protected $with = ['translations'];
    use HasFactory, HasTranslations;
    protected $appends = ['list_identifier', 'translations', 'headers','item_count'];
    public $translatable = ['name', 'description'];
    public static $createRules = [
        // 'name' => 'required',
        // 'description' => 'required',

    ];
    public static $updateRules = [
        // 'name' => 'required',
        // 'description' => 'required',
    ];
    public function scopeSearch($query, Request $request)
    {
    }
    public function getListIdentifierAttribute()
    {
        return 'category.name';
    }
    public function items()
    {
        return $this->belongsToMany(Item::class,'item_categories');
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function getItemCountAttribute()
    {
        return $this->items()->count();
    }
    // public function getPostCountAttribute()
    // {
    //     return $this->posts()->count();
    // }
    public function getHeadersAttribute()
    {
        return [
            'id',
            'name',
            'discreption'
        ];
    }
    public function accessories(){
        return $this->hasMany(Accessor::class);
    }
}
