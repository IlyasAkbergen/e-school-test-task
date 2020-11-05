<?php

namespace Database\Factories;

use App\Models\Lesson;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lesson::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $time = Carbon::parse($this->faker->dateTimeThisMonth);
        return [
            'starts_at' => $time,
            'ends_at' => Carbon::parse($time)->addMinutes(45),
            'subject_id' => rand(1, 3),
            'type_id' => rand(1, 3),
            'quarter' => rand(1, 4)
        ];
    }
}
