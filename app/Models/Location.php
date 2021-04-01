<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class Location extends BaseModel
{
    use HasFactory;
    protected $guarded = [];
    public function task(){
        return $this->belongsTo(Task::class);
    }
    public static $createRules= [
        'longtude'=>'required|numeric',
        'latitude'=>'required|numeric'
    ];
    public static $updateRules= [
        'longtude'=>'sometimes|numeric',
        'latitude'=>'sometimes|numeric'
    ];
    public function scopeSearch($query,Request $request){

    }
}
