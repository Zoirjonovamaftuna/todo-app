<?php

namespace App\UseCases\Todo;

use App\Models\Todo;

class StoreTodoUseCase
{
    public function execute(int $todo_list_id, string $title): Todo
    {
        $new_todo = new Todo();
        $new_todo->title = $title;
        $new_todo->done = false;
        $new_todo->todoList()->associate($todo_list_id);
        $new_todo->save();

        return $new_todo;
    }
}
