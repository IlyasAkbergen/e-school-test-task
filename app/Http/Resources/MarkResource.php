<?php

namespace App\Http\Resources;

use App\Models\Homework;
use Illuminate\Http\Resources\Json\JsonResource;

class MarkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $is_homework = $this->markable_type == Homework::class;

        return [
            'id' => $this->id,
            'value' => $this->value,
            'starts_at' => $is_homework
                ? $this->markable->lesson->starts_at : $this->markable->starts_at,
            'type' => $is_homework ? 'ДЗ' : 'Урок',
            'markable' => $this->whenLoaded(
                'markable',
                $this->resource->markable),
            'pupil' => $this->whenLoaded(
                'pupil',
                $this->resource->pupil)
        ];
    }
}
