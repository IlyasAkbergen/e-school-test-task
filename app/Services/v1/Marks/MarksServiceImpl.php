<?php


namespace App\Services\v1\Marks;


use App\Models\Mark;

class MarksServiceImpl implements MarksService
{
    public function getMarksPerGroup($group_id, $subject_id, $quarter = null) {
        $result = Mark::with([
            'pupil', 'markable.subject'
        ])->whereHas('markable.subject', function ($q) use ($subject_id, $quarter) {
            return $q->where('id', $subject_id)
                ->when(!empty($quarter), function ($query) use($quarter) {
                    $query->where('quarter', $quarter);
                });
        })->whereHas('pupil', function ($q) use ($group_id) {
            return $q->where('group_id', $group_id);
        })
        ->get();

        return $result;
    }

    public function getMarksPerPupil($user_id, $quarter = null) {
        return 'success';
    }
}