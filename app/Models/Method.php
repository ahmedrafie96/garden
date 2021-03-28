<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Method extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function payment(){
        return $this->belongsTo(Payment::class);
    }
    public static $createRules= [];
    public static $updateRules= [];
    public function scopeSearch($query,Request $request){

    }
}
