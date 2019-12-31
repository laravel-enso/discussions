<?php

namespace LaravelEnso\Discussions\App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use LaravelEnso\TrackWho\App\Http\Resources\TrackWho;

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
