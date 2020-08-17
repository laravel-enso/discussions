<?php

namespace LaravelEnso\Discussions\Upgrades;

use LaravelEnso\Permissions\Models\Permission;
use LaravelEnso\Upgrade\Contracts\MigratesPostDataMigration;
use LaravelEnso\Upgrade\Contracts\MigratesStructure;
use LaravelEnso\Upgrade\Traits\StructureMigration;

class RepliesStructure implements MigratesStructure, MigratesPostDataMigration
{
    use StructureMigration;

    protected $permissions = [
        ['name' => 'core.discussions.replies.store', 'description' => 'Store a new reply', 'is_default' => true],
        ['name' => 'core.discussions.replies.update', 'description' => 'Update reply', 'is_default' => true],
        ['name' => 'core.discussions.replies.destroy', 'description' => 'Delete reply', 'is_default' => true],
    ];

    protected $roles = ['admin', 'supervisor'];

    public function migratePostDataMigration(): void
    {
        Permission::where('name', 'like', 'core.discussions.%Reply')
            ->delete();
    }

    public function isMigrated(): bool
    {
        return Permission::where('name', 'like', 'core.discussions.%Reply')
            ->doesntExist();
    }
}
