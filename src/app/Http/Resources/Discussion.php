<?php

namespace LaravelEnso\Discussions\app\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use LaravelEnso\TrackWho\app\Http\Resources\TrackWho;

class Discussion extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'owner' => new TrackWho($this->whenLoaded('createdBy')),
            // 'taggedUsers' => $this->whenLoaded('taggedUsers', $this->taggedUserList()),
            'isEditable' => $this->isEditable(),
            'reactions' => Reaction::collection($this->whenLoaded('reactions')),
            'replies' => Reply::collection($this->whenLoaded('replies')),
            'createdAt' => $this->created_at->toDatetimeString(),
            'updatedAt' => $this->updated_at->toDatetimeString(),
        ];
    }

    private function taggedUserList()
    {
        return $this->taggedUsers
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'fullName' => $user->fullName,
                ];
            });
    }
}
