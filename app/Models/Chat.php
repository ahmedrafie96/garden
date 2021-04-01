<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class Chat extends BaseModel
{
    use HasFactory;
    protected $guarded = [];
    public function messages(){
        return $this->hasMany(Message::class);
    }
    public function customer(){
        return $this->hasOneThrough(Customer::class,Task::class);
    }
    public function gardner(){
        return $this->hasOneThrough(Gardner::class,Task::class);
    }
    public function task(){
        return $this->belongsTo(Task::class);
    }
    public static $createRules= [];
    public static $updateRules= [];
    public function scopeSearch($query,Request $request){

    }
}
