<?php

namespace Database\Factories;

use App\Models\Gardner;
use App\Models\Purchase;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'purchase_id'=>Purchase::factory(),
            'gardner_id'=>Gardner::factory(),
            'longtude'=>$this->faker->longitude,
            'latitude'=>$this->faker->latitude
        ];
    }
}
