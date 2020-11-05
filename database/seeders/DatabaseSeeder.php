<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Homework;
use App\Models\LessonType;
use App\Models\Mark;
use App\Models\MarkType;
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

        MarkType::insert([
            [
                'id' => MarkType::MARK_TYPE_EXAMINE,
                'name' => 'Экзамены',
            ],
            [
                'id' => MarkType::MARK_TYPE_LESSON,
                'name' => 'Обычные уроки',
            ],
            [
                'id' => MarkType::MARK_TYPE_AUTO_CHECK,
                'name' => 'Уроки с автоматической проверкой',
            ],
        ]);

        // $this->call(UsersSeeder::class);

        $group = Group::factory()
            ->hasLessons(30, [
                'type_id' => function() use ($lessonTypes) {
                    return rand(
                        $lessonTypes->first()->id,
                        $lessonTypes->last()->id
                    );
                },
                'subject_id' => function() use ($subjects) {
                    return rand(
                        $subjects->first(),
                        $subjects->last()
                    );
                }
            ])
            ->hasPupils(5)
            ->create([
                'name' => '11A',
                'grade' => 11
            ]);


        $group->pupils->each(function ($pupil) use ($group) {
            $group->load(['lessons.homework']);
            $group->lessons->each(function ($lesson) use ($pupil) {

                $lesson->marks()->save(new Mark([
                        'value' => rand(1, 7),
                        'type_id' => MarkType::MARK_TYPE_LESSON,
                        'user_id' => $pupil->id
                    ]
                ));

                $homework = $lesson->homework;

                if (empty($homework)) {
                    Homework::factory()
                        ->hasMarks(1, [
                            'value' => rand(1, 7),
                            'type_id' => MarkType::MARK_TYPE_LESSON,
                            'user_id' => $pupil->id,
                        ])
                        ->create([
                            'lesson_id' => $lesson->id
                        ]);
                } else {
                    $homework->marks()->save(new Mark([
                        'value' => rand(1, 7),
                        'type_id' => MarkType::MARK_TYPE_LESSON,
                        'user_id' => $pupil->id
                    ]));
                }
            });
        });
    }
}
