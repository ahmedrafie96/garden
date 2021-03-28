<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Tax extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['list_identifier'];

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
    public function getListIdentifierAttribute()
    {
        return 'tax.name';
    }
}
