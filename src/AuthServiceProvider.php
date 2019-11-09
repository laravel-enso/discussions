<?php

namespace LaravelEnso\Discussions;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use LaravelEnso\Discussions\app\Models\Discussion;
use LaravelEnso\Discussions\app\Models\Reply;
use LaravelEnso\Discussions\app\Policies\DiscussionPolicy;
use LaravelEnso\Discussions\app\Policies\ReplyPolicy;

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
