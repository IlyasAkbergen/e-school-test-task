<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 7.06.2020
 * Time: 13:25
 */

namespace App\Http\Controllers\Api\V1\Marks;

use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\Api\V1\Marks\MarksPerGroupRequest;
use App\Http\Requests\Api\V1\Marks\MarksPerPupilRequest;
use App\Services\v1\Marks\MarksService;

class MarksController extends ApiBaseController
{

    protected $marksService;

    /**
     * MarksController constructor.
     * @param MarksService $marksService
     */
    public function __construct(MarksService $marksService)
    {
        $this->marksService = $marksService;
    }

    /**
     * @response 400 {
     * "errorCode": 1,
     * "errors": {
     * "group_id": [
     * "Не выбран класс"
     * ],
     * "subject_id": [
     * "Не выбран предмет"
     * ],
     * "quarter": [
     * "Четверть может быть только от 1 до 4"
     * ]
     * },
     * "success": false
     * }
     * @param MarksPerGroupRequest $request
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function getMarksPerGroup(MarksPerGroupRequest $request) {
        return $this->successResponse(
            $this->marksService->getMarksPerGroup($request)
        );
    }

    /**
     * @response 400 {
     * "errorCode": 1,
     * "errors": {
     * "user_id": [
     * "The user id field is required."
     * ],
     * "quarter": [
     * "The selected quarter is invalid."
     * ]
     * },
     * "success": false
     * }
     * @param MarksPerPupilRequest $request
     * @return \Illuminate\Http\JsonResponse|object
     */
    function getMarksPerPupil(MarksPerPupilRequest $request) {
        return $this->successResponse(
            $this->marksService->getMarksPerPupil($request)
        );
    }
}