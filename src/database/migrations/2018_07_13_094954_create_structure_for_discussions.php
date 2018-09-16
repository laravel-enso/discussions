<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForDiscussions extends StructureMigration
{
    protected $permissionGroup = ['name' => 'core.discussions', 'description' => 'Discussions Permission Group'];

    protected $permissions = [
        ['name' => 'core.discussions.index', 'description' => 'Show index for discussion', 'type' => 0, 'is_default' => true],
        ['name' => 'core.discussions.store', 'description' => 'Store a new discussion', 'type' => 1, 'is_default' => true],
        ['name' => 'core.discussions.show', 'description' => 'Show discussion', 'type' => 1, 'is_default' => true],
        ['name' => 'core.discussions.update', 'description' => 'Update discussion', 'type' => 1, 'is_default' => true],
        ['name' => 'core.discussions.destroy', 'description' => 'Delete discussion', 'type' => 1, 'is_default' => true],
        ['name' => 'core.discussions.storeReply', 'description' => 'Store a new reply', 'type' => 1, 'is_default' => true],
        ['name' => 'core.discussions.updateReply', 'description' => 'Update reply', 'type' => 1, 'is_default' => true],
        ['name' => 'core.discussions.destroyReply', 'description' => 'Delete reply', 'type' => 1, 'is_default' => true],
        ['name' => 'core.discussions.react', 'description' => 'React on reactable', 'type' => 1, 'is_default' => true],
        ['name' => 'core.discussions.taggableUsers', 'description' => 'Get taggable users', 'type' => 1, 'is_default' => true],
    ];

    protected $menu = null;

    protected $parentMenu = '';
}
