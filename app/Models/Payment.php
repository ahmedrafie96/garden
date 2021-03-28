<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Payment extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function method(){
        return $this->hasOne(Method::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function customer(){
        return $this->hasOneThrough(Customer::class,Order::class);
    }
    public static $createRules= [
        'order_id'=>'required|exists:orders,id',
        'amount'=>'required|numeric'
    ];
    public static $updateRules= [
        'order_id'=>'sometimes|exists:orders,id',
        'amount'=>'sometimes|numeric'    
    ];
    public function scopeSearch($query,Request $request){

    }
}
