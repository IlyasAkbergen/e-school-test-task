<?php


namespace App\Services\v1\Marks;

use App\Http\Requests\Api\V1\Marks\MarksPerGroupRequest;
use App\Http\Requests\Api\V1\Marks\MarksPerPupilRequest;

interface MarksService
{
    public function getMarksPerGroup(MarksPerGroupRequest $request);

    public function getMarksPerPupil(MarksPerPupilRequest $request);
}