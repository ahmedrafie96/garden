<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model

{
    protected $guarded = [];
    use HasFactory;
    
    public static $createRules=[
        'rank'=>'required|integer|min:1|max:5'
    ];
}
