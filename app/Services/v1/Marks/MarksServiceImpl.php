<?php


namespace App\Services\v1\Marks;


use App\Http\Resources\MarkResource;
use App\Models\Homework;
use App\Models\Lesson;
use App\Models\Mark;
use Carbon\Carbon;

class MarksServiceImpl implements MarksService
{
    public function getMarksPerGroup($group_id, $subject_id, $quarter = null) {
        $result = Mark::with([
            'pupil', 'markable.subject', 'markable.lesson'
        ])
        ->whereHasMorph('markable',
            [Lesson::class, Homework::class],
            function ($q, $type) use ($subject_id, $quarter) {
                if ($type == Lesson::class) {
                    $q->where('subject_id', $subject_id)
                        ->when(!empty($quarter), function ($query) use ($quarter) {
                            $query->where('quarter', $quarter);
                        });
                } else {
                    $q->whereHas('subject', function ($query) use ($subject_id, $quarter) {
                        $query->where('subjects.id', $subject_id);
                    })
                    ->when(!empty($quarter), function ($query) use ($quarter) {
                        $query->whereHas('lesson', function ($q) use ($quarter) {
                            $q->where('quarter', $quarter);
                        });
                    });
                }
            }
        )
        ->whereHas('pupil', function ($q) use ($group_id) {
            $q->where('group_id', $group_id);
        })
        ->get()
        ->sortBy(function ($item) {
            return Carbon::parse(isset($item->markable->lesson)
                ? $item->markable->lesson->starts_at
                : $item->markable->starts_at
            );
        })
        ->groupBy('pupil.name')
        ->map(function ($marks) {
            return MarkResource::collection($marks);
        });

        return $result;
    }

    public function getMarksPerPupil($user_id, $quarter = null) {
        return 'success';
    }
}