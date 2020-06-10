<?php

namespace LaravelEnso\Discussions\App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use LaravelEnso\Core\App\Http\Resources\User;

class Reaction extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'owner' => new User($this->whenLoaded('createdBy')),
        ];
    }
}
