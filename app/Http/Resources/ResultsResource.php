<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResultsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'region' => $this->region,
            'location' =>  $this->location,
            'city' =>  $this->city,
            'name' => $this->name,
            'active_years' => $this->active_years,
            'person_type' => $this->person_type,
            'job_title' => $this->job_title,
            'match_rate' => $this->pivot->match_rate
        ];
    }
}
