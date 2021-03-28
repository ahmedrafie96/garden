<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Item;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'price'=>random_int(1,1000) * random_int(1,100)/100,
            'available_qty'=>random_int(1,200),
            'type_id'=>Type::factory(),
            'gallery_id'=>Gallery::factory(),
            'code'=>$this->faker->word,
            'category_id'=>Category::factory()
        ];
    }
}
