<?php

namespace LaravelEnso\Discussions\app\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use LaravelEnso\Core\app\Models\User;
use LaravelEnso\Discussions\app\Models\Reply;

class ReplyPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ($user->isAdmin() || $user->isSupervisor()) {
            return true;
        }
    }

    public function handle(User $user, Reply $reply)
    {
        return $user->id === intval($reply->created_by);
    }
}
