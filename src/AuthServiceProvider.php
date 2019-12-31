<?php

namespace LaravelEnso\Discussions;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use LaravelEnso\Discussions\App\Models\Discussion;
use LaravelEnso\Discussions\App\Models\Reply;
use LaravelEnso\Discussions\App\Policies\Discussion as DiscussionPolicy;
use LaravelEnso\Discussions\App\Policies\Reply as ReplyPolicy;

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
