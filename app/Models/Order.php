<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Laratrust\Contracts\Ownable;

class Order extends BaseModel implements Ownable
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['list_identifiers'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public static $createRules = [
        'customer_id' => 'required',
        'tax_id' => 'sometimes|exists:taxes,id',
        'discount' => 'nullable'
    ];
    public static $updateRules = [
        'customer_id' => 'nullable',
        'tax_id' => 'sometimes|exists:taxes',
        'discount' => 'nullable'
    ];
    public function scopeSearch($query, Request $request)
    {
    }
    public function ownerKey($owner)
    {
        return $this->customer->id;
    }
    public function getListIdentifiersAttribute()
    {
        return ['order.id'];
    }
}
