<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use App\Traits\HasTranslations;

class Item extends BaseModel
{
    use HasFactory, HasTranslations;

    protected $guarded = [];
    protected $appends = ['list_identifiers', 'image', 'translations', 'headers', 'liked'];
    protected $with = ['type'];
    public $translatable = ['name','description'];
    public function accessors()
    {
        return $this->hasMany(Accessor::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class,'item_categories');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'item_tags');
    }
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
    public static $createRules = [
        'parent_id' => 'sometimes|exists:items,id',
        'gallery_id' => 'sometimes|exists:galleries,id',
        // 'name'=>'required',
        'code' => 'required',
        'category_id' => 'sometimes|exists:categories,id',
        'type_id' => 'required|exists:types,id',
        // 'available_qty' => 'integer',
        'price' => 'numeric'
    ];
    public static $updateRules = [
        'parent_id' => 'sometimes|exists:items,id',
        // 'name'=>'nullable',
        'code' => 'nullable',
        'category_id' => 'sometimes|exists:categories,id',
        'type_id' => 'sometimes|exists:types,id',
        'gallery_id' => 'sometimes|exists:galleries,id',
        // 'available_qty' => 'sometimes|integer',
        'price' => 'numeric'
    ];
    public function scopeSearch($query, Request $request)
    {
        $locale = app()->getLocale();
        $query->when($request->ids,function($query,$ids){
            $query->whereIn('id',$ids);
        });
        $query->when($request->name,function($query,$name)use($locale){
            $query->where('name->'.$locale,'like','%'.$name.'%');
        });
        $query->when($request->categories,function($query,$categories){
            $query->join('item_categories','items.id','item_categories.item_id')->whereIn('category_id',$categories);
        });
    }
    
    public function getListIdentifiersAttribute()
    {
        return ['item.name', 'accessor.name'];
    }
    public function getImageAttribute()
    {
        return $this->gallery ? $this->gallery->cover_image : null;
    }
    public function getHeadersAttribute()
    {
        return [
            'id',
            'name',
            'code',
            'price',
            'available_qty',
        ];
    }
    public function reactions()
    {
        return $this->morphMany(Reaction::class, 'reactable');
    }
    public function getLikedAttribute()
    {
        $user = request()->attributes->get('user');
        if (!$user)
            return false;
        return $this->reactions()->where('user_id', '=', $user->id)->where('user_type', '=', get_class($user))->count() > 0;
    }
}
