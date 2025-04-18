<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date->format('Y-m-d'),
            'time_from' => $this->time_from,
            'time_to' => $this->time_to,
            'start_date_time' => $this->start_date_time,
            'movie' => $this->whenLoaded('movie'),
            'hall' => $this->whenLoaded('hall'),
            'available_seats' => $this->hall->capacity - $this->tickets->count(),
        ];
    }
}