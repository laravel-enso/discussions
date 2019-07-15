<?php

namespace LaravelEnso\Discussions\app\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use LaravelEnso\TrackWho\app\Http\Resources\TrackWho;

class Reaction extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'owner' => new TrackWho($this->whenLoaded('createdBy')),
        ];
    }
}
