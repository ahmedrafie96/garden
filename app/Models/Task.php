<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class Task extends BaseModel
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['list_identifiers', 'headers'];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function gardner()
    {
        return $this->belongsTo(Gardner::class);
    }
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
    public static $createRules = [
        'purchase_id' => 'sometimes|exists:purchases,id',
        'gardner_id' => 'sometimes|exists:gardners,id',
        'city_id' => 'required|exists:cities,id'
    ];
    public static $updateRules = [
        'purchase_id' => 'sometimes|exists:purchases,id',
        'gardner_id' => 'sometimes|exists:gardners,id',
        'city_id' => 'sometimes|exists:cities,id'
    ];
    public function scopeSearch($query, Request $request)
    {
    }
    public function getListIdentifiersAttribute()
    {
        return ['task.description'];
    }
    public function getLocationAttribute()
    {
        return "$this->lng , $this->lat";
    }
    public function getFinalLocationAttribute()
    {
        return "$this->final_lng , $this->final_lat";
    }
    public function getHeadersAttribute()
    {
        return [
            'id',
            'customer.name',
            'gardner.name',
            'discreption',
            'plant_location_type',
            'location',
            'final_location',
            'tree_number',
            'status',
            'created_at',
            'updated_at'
        ];
    }
}
