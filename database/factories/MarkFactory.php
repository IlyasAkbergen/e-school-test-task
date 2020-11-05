<?php

namespace Database\Factories;

use App\Models\Mark;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mark::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value' => rand(1, 7),
            'user_id' => rand(1, 5),
            'type_id' => rand(1, 3),
            'markable_id' => rand(1, 10),
            'markable_type' => rand(1, 10)
        ];
    }
}
