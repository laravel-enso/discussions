<?php

namespace LaravelEnso\Discussions\Upgrades;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use LaravelEnso\Permissions\Models\Permission;
use LaravelEnso\Roles\Models\Role;
use LaravelEnso\Upgrade\Contracts\MigratesData;

class RenamePermissions implements MigratesData
{
    protected $permissions = [
        'core.discussions.react' => 'core.discussions.reactions.toggle',
        'core.discussions.storeReply' => 'core.discussions.replies.store',
        'core.discussions.updateReply' => 'core.discussions.replies.update',
        'core.discussions.destroyReply' => 'core.discussions.replies.destroy',
    ];

    public function migrateData(): void
    {
        (new Collection($this->permissions))
            ->each(fn ($new, $old) => Permission::whereName($old)->update(['name' => $new]));

        if (App::isLocal()) {
            Role::get()
                ->reject(fn ($role) => $role->name === Config::get('enso.config.defaultRole'))
                ->each->writeConfig();
        }
    }

    public function isMigrated(): bool
    {
        return Permission::whereIn('name', (new Collection($this->permissions))->keys())
            ->doesntExist();
    }
}
