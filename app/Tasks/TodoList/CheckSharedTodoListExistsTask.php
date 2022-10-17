<?php

namespace App\Tasks\TodoList;

use App\Models\SharedTodoList;
use Exception;

class CheckSharedTodoListExistsTask
{
    /**
     * @throws Exception
     */
    public function execute(int $from_user_id, int $to_user_id,  $todo_list_id): void
    {
        /** @var SharedTodoList $shared_todo_list */
        $shared_todo_list = SharedTodoList::query()
            ->where('from_user_id', $from_user_id)
            ->where('to_user_id', $to_user_id)
            ->where('todo_list_id', $todo_list_id)
            ->exists();

        if ($shared_todo_list) {
            throw new Exception('Shared Todo List not found', 404);
        }
    }

}
