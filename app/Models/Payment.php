<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Laratrust\Contracts\Ownable;
use Stripe\Stripe;

class Payment extends BaseModel implements Ownable
{
    use HasFactory;
    protected $guarded = [];
    public function method()
    {
        return $this->hasOne(Method::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function customer()
    {
        return $this->hasOneThrough(Customer::class, Order::class);
    }
    public static $createRules = [
        'order_id' => 'required|exists:orders,id',
        'amount' => 'sometimes|numeric'
    ];
    public static $updateRules = [
        'order_id' => 'sometimes|exists:orders,id',
        'amount' => 'sometimes|numeric'
    ];
    public function scopeSearch($query, Request $request)
    {
    }
    public function ownerKey($owner)
    {
        return $this->customer->id;
    }
    public function confirm($card_token)
    {
        $this->update(['amount'=>$this->order->total_price]);
        Stripe::setApiKey('sk_test_51HflfKI5KESslpeP2pWDNmRBlrazJSWozUhFxglLH9ACsWS6wZcIu959HLqlefVbOVF3erjVdlkYlWXdt9w4U24q00aCnApNMT');
        $charge = \Stripe\Charge::create([
            'amount' => intval($this->amount*100),
            'currency' => 'usd',
            'source' => $card_token,
            'description'=>'Order '.$this->order_id
        ]);
    }
}
