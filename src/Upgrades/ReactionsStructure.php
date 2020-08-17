<?php

namespace LaravelEnso\Discussions\Upgrades;

use LaravelEnso\Permissions\Models\Permission;
use LaravelEnso\Upgrade\Contracts\MigratesPostDataMigration;
use LaravelEnso\Upgrade\Contracts\MigratesStructure;
use LaravelEnso\Upgrade\Traits\StructureMigration;

class ReactionsStructure implements MigratesStructure, MigratesPostDataMigration
{
    use StructureMigration;

    protected $permissions = [
        ['name' => 'core.discussions.reactions.toggle', 'description' => 'React on reactable', 'is_default' => true],
    ];

    protected $roles = ['admin', 'supervisor'];

    public function migratePostDataMigration(): void
    {
        Permission::whereName('core.discussions.react')
            ->delete();
    }

    public function isMigrated(): bool
    {
        return Permission::whereName('core.discussions.react')
            ->doesntExist();
    }
}
