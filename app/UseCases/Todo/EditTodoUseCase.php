<?php

namespace App\UseCases\Todo;

use App\Models\Todo;
use App\Tasks\Todo\FindTodoByTodoListIdTask;
use Exception;

class EditTodoUseCase
{
    public function __construct(private FindTodoByTodoListIdTask $findTodoByTodoListIdTask)
    {
    }

    /**
     * @throws Exception
     */
    public function execute(int $todo_list_id, int $todo_id, string $title): Todo
    {
        $todo = $this->findTodoByTodoListIdTask->execute($todo_list_id, $todo_id);
        $todo->title = $title;
        $todo->save();

        return $todo;
    }
}
