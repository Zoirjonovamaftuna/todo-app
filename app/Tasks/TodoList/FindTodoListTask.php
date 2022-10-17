<?php

namespace App\Tasks\TodoList;

use App\Models\TodoList;
use Exception;

class FindTodoListTask
{
    /**
     * @throws Exception
     */
    public function execute(int $todo_list_id): TodoList
    {
        /** @var TodoList $todo_list */
        $todo_list = TodoList::query()->find($todo_list_id);
        if ($todo_list == null) {
            throw new Exception('Todo List not found', 404);
        }
        return $todo_list;
    }

}
