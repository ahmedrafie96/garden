<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Country extends Model
{
    use HasFactory,HasTranslations;
    protected $appends = ['list_identifiers','translations','headers'];
    public $translatable = ['name'];
    protected $guarded = [];
    public static $createRules = [
        'name' => 'nullable',
    ];
    public static $updateRules = [
        'name' => 'nullable',
    ];
    public function scopeSearch($query, Request $request)
    {
    }
    public function getListIdentifiersAttribute()
    {
        return ['country.name'];
    }
    public function getHeadersAttribute()
    {
        return [
            'id',
            'name',
        ];
    }
}
