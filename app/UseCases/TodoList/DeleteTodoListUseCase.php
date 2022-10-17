<?php

namespace App\UseCases\TodoList;

use App\Models\Todo;
use App\Tasks\TodoList\FindTodoListByUserTask;
use Exception;
use Illuminate\Support\Facades\DB;

class DeleteTodoListUseCase
{
    public function __construct(private FindTodoListByUserTask $findTodoListByUserTask)
    {
    }

    /**
     * @throws Exception
     */
    public function execute(int $todo_list_id, int $user_id): void
    {
        $todo_list = $this->findTodoListByUserTask->execute($todo_list_id, $user_id);
        DB::transaction(function () use ($todo_list_id, $todo_list) {
            Todo::query()->where('todo_list_id', $todo_list_id)->delete();
            $todo_list->delete();
        });
    }
}
