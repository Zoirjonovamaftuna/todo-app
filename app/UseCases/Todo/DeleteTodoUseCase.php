<?php

namespace App\UseCases\Todo;

use App\Tasks\Todo\FindTodoByTodoListIdTask;
use App\Tasks\TodoList\FindTodoListByUserTask;
use Exception;

class DeleteTodoUseCase
{
    public function __construct(
        private FindTodoListByUserTask $findTodoListByUserTask,
        private FindTodoByTodoListIdTask $findTodoByTodoListIdTask,
    )
    {
    }

    /**
     * @throws Exception
     */
    public function execute(int $todo_list_id, int $todo_id, int $user_id): void
    {
        $todo_list = $this->findTodoListByUserTask->execute($todo_list_id, $user_id);
        $todo = $this->findTodoByTodoListIdTask->execute($todo_list->id, $todo_id);
        $todo->delete();
    }
}
