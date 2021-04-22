<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class Accessor extends BaseModel
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['list_identifiers', 'headers'];
    protected $with = ['item','accessor'];
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function accessor()
    {
        return $this->belongsTo(Item::class, 'accessor_item_id');
    }
    public static $createRules = [
        'item_id' => 'sometimes|exists:items,id',
        'accessor_item_id' => 'sometimes|exists:items,id',
        'qty' => 'integer',
    ];
    public static $updateRules = [
        'item_id' => 'sometimes|exists:items,id',
        'accessor_item_id' => 'sometimes|exists:items,id',
        'qty' => 'integer',
    ];
    public function getListIdentifiersAttribute()
    {
        return ['item.name','accessor.name'];
    }
    public function scopeSearch($query, Request $request)
    {
    }
    // public function getImageAttribute()
    // {
    //     return $this->item->image;
    // }
    public function getHeadersAttribute()
    {
        return [
            'id',
            'item',
            'accessor',
            'qty',
        ];
    }
}
