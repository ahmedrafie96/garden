<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $guarded = [];
    public static $createRules = [
        'key' => 'required',
        'value' => 'required'
    ];
    public function scopeSearch($request,$query){

    }
}
