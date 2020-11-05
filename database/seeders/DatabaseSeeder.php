<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\LessonType;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $subjects = Subject::factory()->count(3)
            ->create()
            ->pluck('id');
        $lessonTypes = LessonType::factory()->count(3)->create();

        // $this->call(UsersSeeder::class);

        Group::factory()
            ->hasLessons(30, [
                'type_id' => rand(
                    $lessonTypes->first()->id,
                    $lessonTypes->last()->id
                ),
                'subject_id' => rand(
                    $subjects->first(),
                    $subjects->last()
                )
            ])
            ->hasPupils(5)
            ->create([
                'name' => '11A',
                'grade' => 11
            ]);
    }
}
