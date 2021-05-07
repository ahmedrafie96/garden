<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class City extends Model
{
    use HasFactory,HasTranslations;
    protected $appends = ['list_identifiers','translations','headers','image'];
    public $translatable = ['name'];
    protected $guarded = [];
    protected $with=['gallery'];
    public static $createRules = [
        'name' => 'nullable',
        'country_id'=>'required',
        'gallery_id'=>'nullable'
    ];
    public static $updateRules = [
        'name' => 'nullable',
        'country_id'=>'nullable',
        'gallery_id'=>'nullable'
    ];
    public function scopeSearch($query, Request $request)
    {
        $query->when($request->category_id,function($query,$id){
            $query->where('category_id','=',$id);
        });
    }
    public function getImageAttribute()
    {
        return $this->gallery ? $this->gallery->cover_image : null;
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
    public function gallery(){
        return $this->belongsTo(Gallery::class);
    }
}
