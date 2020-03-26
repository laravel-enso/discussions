<?php

namespace LaravelEnso\Discussions\App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use LaravelEnso\Core\App\Models\User;
use LaravelEnso\Discussions\App\Models\Reply as Model;

class Reply
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->isAdmin() || $user->isSupervisor()) {
            return true;
        }
    }

    public function handle(User $user, Model $reply)
    {
        return $user->id === (int) $reply->created_by;
    }
}
