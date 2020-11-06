<?php

namespace App\Http\Requests\Api\V1\Marks;

use App\Http\Requests\ApiBaseRequest;
use Illuminate\Validation\Rule;

/**
 * @bodyParam  group_id int required The id of needed group
 * @bodyParam  subject_id int required The id of needed subject
 * @bodyParam  quarter int optional The quarter in range 1-4
 */
class MarksPerGroupRequest extends ApiBaseRequest
{
    public function messages()
    {
        return [
            'quarter.in' => 'Четверть может быть только от 1 до 4',
            'group_id.required' => 'Не выбран класс',
            'subject_id.required' => 'Не выбран предмет'
        ];
    }

    public function injectedRules()
    {
        return [
            'group_id' => ['required', 'numeric'],
            'subject_id' => ['required', 'numeric'],
            'quarter' => [Rule::in([1, 2, 3, 4])],
        ];
    }
}
