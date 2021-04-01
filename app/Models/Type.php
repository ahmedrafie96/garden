<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Type extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['list_identifiers'];
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public static $createRules = [
        'parent_id' => 'sometimes|exists:types,id',
        'name' => 'required',
        'description' => 'nullable'
    ];
    public static $updateRules = [
        'parent_id' => 'sometimes|exists:types,id',
        'name' => 'nullable',
        'description' => 'nullable'
    ];
    public function scopeSearch($query, Request $request)
    {
    }
    public function getListIdentifiersAttribute()
    {
        return ['type.name'];
    }
}
