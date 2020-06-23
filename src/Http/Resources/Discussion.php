<?php

namespace LaravelEnso\Discussions\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use LaravelEnso\Core\Http\Resources\User;

class Discussion extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'owner' => new User($this->whenLoaded('createdBy')),
            // 'taggedUsers' => $this->whenLoaded('taggedUsers', $this->taggedUserList()),
            'isEditable' => Auth::user()->can('handle', $this->resource),
            'reactions' => Reaction::collection($this->whenLoaded('reactions')),
            'replies' => Reply::collection($this->whenLoaded('replies')),
            'createdAt' => $this->created_at->toDatetimeString(),
            'updatedAt' => $this->updated_at->toDatetimeString(),
        ];
    }

    private function taggedUserList()
    {
        return $this->taggedUsers->map(fn ($user) => [
            'id' => $user->id,
            'fullName' => $user->fullName,
        ]);
    }
}
