<?php


namespace App\Services\v1\Marks;


use App\Http\Requests\Api\V1\Marks\MarksPerGroupRequest;
use App\Http\Requests\Api\V1\Marks\MarksPerPupilRequest;

class MarksServiceImpl implements MarksService
{
    public function getMarksPerGroup(MarksPerGroupRequest $request) {
        return 'success';
    }

    public function getMarksPerPupil(MarksPerPupilRequest $request) {
        return 'success';
    }
}