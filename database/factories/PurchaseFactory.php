<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Order;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Purchase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_id'=>Item::factory(),
            'order_id'=>Order::factory(),
            'quantity'=>random_int(1,100),
            'free_qty'=>random_int(0,10),
            'discount'=>random_int(0,100)/100,
        ];
    }
}
