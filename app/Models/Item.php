<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use App\Traits\HasTranslations;

class Item extends BaseModel
{
    use HasFactory, HasTranslations;

    protected $guarded = [];
    protected $appends = ['list_identifiers', 'image', 'translations', 'headers', 'liked', 'category_ids','average_rank' ,  'rank_count' ];
    protected $with = ['type'];
    public function getCategoryIdsAttribute()
    {
        return $this->categories()->pluck('categories.id');
    }
    public $translatable = ['name', 'description'];

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
        return $this->belongsToMany(Category::class, 'item_categories');
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
        // 'type_id' => 'required|exists:types,id',
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
        // $locale = app()->getLocale();
        $query->when($request->ids, function ($query, $ids) {
            $query->whereIn('id', $ids);
        });
        $query->when($request->name, function ($query, $name) {
            $query->whereRaw(' JSON_EXTRACT(name, "$") like "%' . $name . '%"');
            // $query->where('name->en like', '%' . $name . '%');
        });
        $query->when($request->categories, function ($query, $categories) {
            $query->join('item_categories', 'items.id', 'item_categories.item_id')->whereIn('category_id', $categories);
        });
        $query->when($request->price, function ($query, $price) {
            $query->where('price', '<=', $price);
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
    public function getRelatedItemsAttribute(){
        return Item::join('item_categories','item_categories.item_id','items.id')->whereIn('category_id',$this->categories()->pluck('id'))->limit(4)->get();
    }
    public function ranks(){
        return $this->hasMany(Rank::class);
    }
    public function getAverageRankAttribute(){
        return $this->ranks()->avg('rank');
    }
    public function getRankCountAttribute(){
        return $this->ranks()->count();
    }

}
