<?php

namespace App\UseCases\TodoList;

use App\Models\SharedTodoList;
use App\Models\TodoList;
use App\Tasks\TodoList\CheckSharedTodoListExistsTask;
use App\Tasks\TodoList\FindTodoListByUserTask;
use Exception;

class ShareTodoListUseCase
{
    public function __construct(
        private FindTodoListByUserTask $findTodoListByUserTask,
        private CheckSharedTodoListExistsTask $checkSharedTodoListExistsTask
    )
    {
    }

    /**
     * @param int $todo_list_id
     * @param int $from_user_id
     * @param int $to_user_id
     * @return TodoList
     * @throws Exception
     */
    public function execute(int $todo_list_id, int $from_user_id, int $to_user_id): TodoList
    {
        $todo_list = $this->findTodoListByUserTask->execute($todo_list_id, $from_user_id);
        $this->checkSharedTodoListExistsTask->execute($from_user_id, $to_user_id, $todo_list->id);

        $shared_todo_list = new SharedTodoList();
        $shared_todo_list->fromUser()->associate($from_user_id);
        $shared_todo_list->toUser()->associate($to_user_id);
        $shared_todo_list->todoList()->associate($todo_list);
        $shared_todo_list->save();

        return $todo_list;
    }
}
