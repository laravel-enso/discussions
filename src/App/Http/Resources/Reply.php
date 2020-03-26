<?php

namespace LaravelEnso\Discussions\App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use LaravelEnso\TrackWho\App\Http\Resources\TrackWho;

class Reply extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'owner' => new TrackWho($this->whenLoaded('createdBy')),
            'reactions' => Reaction::collection($this->whenLoaded('reactions')),
            'isEditable' => Auth::user()->can('handle', $this->resource),
            'createdAt' => $this->created_at->toDatetimeString(),
            'updatedAt' => $this->updated_at->toDatetimeString(),
        ];
    }
}
