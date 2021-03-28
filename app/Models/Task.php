<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['list_identifier'];

    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }
    public function location(){
        return $this->belongsTo(Location::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function gardner(){
        return $this->belongsTo(Gardner::class);
    }
    public function chat(){
        return $this->belongsTo(Chat::class);
    }
    public static $createRules= [
        'purchase_id'=>'sometimes|exists:purchases,id',
        'gardner_id'=>'sometimes|exists:gardners,id',
        'location.lng'=>'sometimes|numeric',
        'location.lat'=>'sometimes|numeric'
    ];
    public static $updateRules= [
        'purchase_id'=>'sometimes|exists:purchases,id',
        'gardner_id'=>'sometimes|exists:gardners,id',
        'location.lng'=>'sometimes|numeric',
        'location.lat'=>'sometimes|numeric'
    ];
    public function scopeSearch($query,Request $request){

    }
    public function getListIdentifierAttribute()
    {
        return 'task.description';
    }
}
