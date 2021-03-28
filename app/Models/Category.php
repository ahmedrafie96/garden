<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Category extends Model
{
    protected $guarded = [];
    protected $appends = ['list_identifier', 'item_count', 'post_count'];
    protected $with=[];
    use HasFactory;
    public static $createRules = [
        'name' => 'required',
        'description' => 'required',

    ];
    public static $updateRules = [
        'name' => 'required',
        'description' => 'required',
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
        return $this->hasMany(Item::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function getItemCountAttribute()
    {
        return $this->items()->count();
    }
    public function getPostCountAttribute()
    {
        return $this->posts()->count();
    }
}
