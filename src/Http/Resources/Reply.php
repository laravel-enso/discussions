<?php

namespace LaravelEnso\Discussions\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use LaravelEnso\Core\Http\Resources\User;

class Reply extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'owner' => new User($this->whenLoaded('createdBy')),
            'reactions' => Reaction::collection($this->whenLoaded('reactions')),
            'isEditable' => Auth::user()->can('handle', $this->resource),
            'createdAt' => $this->created_at->toDatetimeString(),
            'updatedAt' => $this->updated_at->toDatetimeString(),
        ];
    }
}
