<?php

namespace App\Tasks\Todo;

use App\Models\Todo;
use Exception;

class FindTodoByTodoListIdTask
{
    /**
     * @throws Exception
     */
    public function execute(int $todo_list_id, int $todo_id): Todo
    {
        /** @var Todo $todo */
        $todo = Todo::query()
            ->where('todo_list_id', $todo_list_id)
            ->find($todo_id);

        if ($todo == null) {
            throw new Exception('Todo not found', 404);
        }

        return $todo;
    }

}
