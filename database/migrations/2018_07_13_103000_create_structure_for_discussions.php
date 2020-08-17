<?php

use LaravelEnso\Migrator\Database\Migration;

class CreateStructureForDiscussions extends Migration
{
    protected array $permissions = [
        ['name' => 'core.discussions.index', 'description' => 'Show index for discussion', 'is_default' => true],
        ['name' => 'core.discussions.store', 'description' => 'Store a new discussion', 'is_default' => true],
        ['name' => 'core.discussions.show', 'description' => 'Show discussion', 'is_default' => true],
        ['name' => 'core.discussions.update', 'description' => 'Update discussion', 'is_default' => true],
        ['name' => 'core.discussions.destroy', 'description' => 'Delete discussion', 'is_default' => true],
        ['name' => 'core.discussions.replies.store', 'description' => 'Store a new reply', 'is_default' => true],
        ['name' => 'core.discussions.replies.update', 'description' => 'Update reply', 'is_default' => true],
        ['name' => 'core.discussions.replies.destroy', 'description' => 'Delete reply', 'is_default' => true],
        ['name' => 'core.discussions.reactions.toggle', 'description' => 'React on reactable', 'is_default' => true],
    ];
}
