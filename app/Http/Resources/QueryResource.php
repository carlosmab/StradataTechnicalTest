<?php

namespace App\Http\Resources;

use App\Models\PublicPerson;
use Illuminate\Http\Resources\Json\JsonResource;

class QueryResource extends JsonResource
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
            'data' => [
                'id' => $this->id,
                'uuid' => $this->uuid,
                'searched_name' => $this->searched_name,
                'match_rate' => $this->match_rate,
                'execution_status' => $this->execution_status,
                'query_date' => $this->created_at->diffForHumans(),
                'results' => ResultsResource::collection($this->results)
            ]
        ];
    }
}
