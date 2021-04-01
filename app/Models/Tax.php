<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class Tax extends BaseModel
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['list_identifiers'];

    public static $createRules= [
        'name'=>'required',
        'percentage'=>'required|numeric'
    ];
    public static $updateRules= [
        'name'=>'sometimes',
        'percentage'=>'sometimes|numeric'
    ];
    public function scopeSearch($query,Request $request){

    }
    public function getListIdentifiersAttribute()
    {
        return ['tax.name'];
    }
}
