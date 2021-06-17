<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends BaseModel
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['list_identifiers'];
    public function getListIdentifiersAttribute()
    {
        return ['tag.name'];
    }
    public static $createRules = [
        'name'=>'required'
    ];
    public static $updateRules = [
        'name'=>'required'
    ];
}
