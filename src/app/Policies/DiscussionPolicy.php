<?php

namespace LaravelEnso\Discussions\app\Policies;

use LaravelEnso\Core\app\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use LaravelEnso\Discussions\app\Models\Discussion;

class DiscussionPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ($user->isAdmin() || $user->isSupervisor()) {
            return true;
        }
    }

    public function handle(User $user, Discussion $discussion)
    {
        return $user->id === intval($discussion->created_by);
    }
}
