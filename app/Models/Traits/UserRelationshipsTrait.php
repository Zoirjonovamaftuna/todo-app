<?php

namespace App\Models\Traits;

use App\Models\TodoList;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserRelationshipsTrait
{
    public function todoLists(): HasMany
    {
        return $this->hasMany(TodoList::class);
    }

    public function sharedTodoListsTo(): BelongsToMany
    {
        return $this->belongsToMany(TodoList::class, 'shared_todo_lists', 'to_user_id', 'from_user_id')
            ->withPivot(['todo_list_id']);
    }

    public function sharedTodoListsFrom(): BelongsToMany
    {
        return $this->belongsToMany(TodoList::class, 'shared_todo_lists', 'from_user_id', 'to_user_id')
            ->withPivot(['todo_list_id']);
    }
}
