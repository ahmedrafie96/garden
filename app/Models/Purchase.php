<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function item(){
        return $this->belongsTo(Item::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function task(){
        return $this->hasOne(Task::class);
    }
    public static $createRules= [
        'order_id'=>'required|exists:orders,id',
        'item_id'=>'required|exists:items,id',
        'quantity'=>'required|integer|min:1',
        'free_quantity'=>'sometimes|min:1',
        'discount'=>'sometimes|numeric'
    ];
    public static $updateRules= [
        'order_id'=>'required|exists:orders,id',
        'item_id'=>'required|exists:items,id',
        'quantity'=>'required|integer|min:1',
        'free_quantity'=>'sometimes|min:1',
        'discount'=>'sometimes|numeric'
    ];
    public function scopeSearch($query,Request $request){

    }
}
