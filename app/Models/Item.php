<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Item extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['list_identifier','image'];
    protected $with=['type'];
    public function items(){
        return $this->hasMany(Item::class);
    }
    public function type(){
        return $this->belongsTo(Type::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class,'item_tags');
    }
    public function gallery(){
        return $this->belongsTo(Gallery::class);
    }
    public static $createRules= [
        'parent_id'=>'sometimes|exists:items,id',
        'gallery_id'=>'sometimes|exists:galleries,id',
        'name'=>'required',
        'code'=>'required',
        'category_id'=>'sometimes|exists:categories,id',
        'type_id'=>'required|exists:types,id',
        'available_qty'=>'integer',
        'price'=>'numeric'
    ];
    public static $updateRules= [
        'parent_id'=>'sometimes|exists:items,id',
        'name'=>'nullable',
        'code'=>'nullable',
        'category_id'=>'sometimes|exists:categories,id',
        'type_id'=>'sometimes|exists:types,id',
        'gallery_id'=>'sometimes|exists:galleries,id',
        'available_qty'=>'sometimes|integer',
        'price'=>'numeric'
    ];
    public function scopeSearch($query,Request $request){

    }
    public function getListIdentifierAttribute()
    {
        return 'item.name';
    }
    public function getImageAttribute(){
        return $this->gallery?$this->gallery->cover_image:null;
    }
}
