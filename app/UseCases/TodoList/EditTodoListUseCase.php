<?php

namespace App\UseCases\TodoList;

use App\Models\TodoList;
use App\Tasks\TodoList\FindTodoListByUserTask;
use Exception;

class EditTodoListUseCase
{
    public function __construct(private FindTodoListByUserTask $findTodoListByUserTask)
    {
    }

    /**
     * @throws Exception
     */
    public function execute(int $todo_list_id, int $user_id, string $name): TodoList
    {
        $todo_list = $this->findTodoListByUserTask->execute($todo_list_id, $user_id);
        $todo_list->name = $name;
        $todo_list->save();

        return $todo_list;
    }
}
