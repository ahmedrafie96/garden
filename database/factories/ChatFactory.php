<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Chat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'task_id'=>Task::factory()
        ];
    }
}
