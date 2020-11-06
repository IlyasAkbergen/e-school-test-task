<?php

namespace App\Http\Requests\Api\V1\Marks;

use App\Http\Requests\ApiBaseRequest;
use Illuminate\Validation\Rule;

/**
 * @bodyParam  user_id int required The id of needed pupil
 * @bodyParam  quarter int optional The quarter in range 1-4
 */
class MarksPerPupilRequest extends ApiBaseRequest
{
    public function injectedRules()
    {
        return [
            'user_id' => ['required', 'numeric'],
            'quarter' => [Rule::in([1, 2, 3, 4])],
        ];
    }
}
