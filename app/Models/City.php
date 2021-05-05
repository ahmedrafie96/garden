<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class City extends Model
{
    use HasFactory,HasTranslations;
    protected $appends = ['list_identifiers','translations','headers'];
    public $translatable = ['name'];
    protected $guarded = [];
    public static $createRules = [
        'name' => 'nullable',
        'country_id'=>'required'
    ];
    public static $updateRules = [
        'name' => 'nullable',
        'country_id'=>'nullable'
    ];
    public function scopeSearch($query, Request $request)
    {
        $query->when($request->category_id,function($query,$id){
            $query->where('category_id','=',$id);
        });
    }
    public function getListIdentifiersAttribute()
    {
        return ['city.name'];
    }
    public function getHeadersAttribute()
    {
        return [
            'id',
            'name',
        ];
    }
}
