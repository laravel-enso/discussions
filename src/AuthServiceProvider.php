<?php

namespace LaravelEnso\Discussions;

use LaravelEnso\Discussions\app\Models\Reply;
use LaravelEnso\Discussions\app\Models\Discussion;
use LaravelEnso\Discussions\app\Policies\ReplyPolicy;
use LaravelEnso\Discussions\app\Policies\DiscussionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Discussion::class => DiscussionPolicy::class,
        Reply::class => ReplyPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
