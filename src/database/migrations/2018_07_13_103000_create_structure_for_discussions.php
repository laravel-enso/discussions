<?php

use LaravelEnso\Migrator\App\Database\Migration;
use LaravelEnso\Permissions\App\Enums\Types;

class CreateStructureForDiscussions extends Migration
{
    protected $permissions = [
        ['name' => 'core.discussions.index', 'description' => 'Show index for discussion', 'type' => Types::Read, 'is_default' => true],
        ['name' => 'core.discussions.store', 'description' => 'Store a new discussion', 'type' => Types::Write, 'is_default' => true],
        ['name' => 'core.discussions.show', 'description' => 'Show discussion', 'type' => Types::Read, 'is_default' => true],
        ['name' => 'core.discussions.update', 'description' => 'Update discussion', 'type' => Types::Write, 'is_default' => true],
        ['name' => 'core.discussions.destroy', 'description' => 'Delete discussion', 'type' => Types::Write, 'is_default' => true],
        ['name' => 'core.discussions.storeReply', 'description' => 'Store a new reply', 'type' => Types::Write, 'is_default' => true],
        ['name' => 'core.discussions.updateReply', 'description' => 'Update reply', 'type' => Types::Write, 'is_default' => true],
        ['name' => 'core.discussions.destroyReply', 'description' => 'Delete reply', 'type' => Types::Write, 'is_default' => true],
        ['name' => 'core.discussions.react', 'description' => 'React on reactable', 'type' => Types::Write, 'is_default' => true],
    ];
}
