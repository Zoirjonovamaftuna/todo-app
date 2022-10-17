<?php

namespace App\UseCases\TodoList;

use App\DTO\TodoListDto;
use App\Models\TodoList;
use App\UseCases\Todo\StoreTodoUseCase;
use Illuminate\Support\Facades\DB;

class StoreTodoListUseCase
{
    public function __construct(private StoreTodoUseCase $storeTodoUseCase)
    {
    }

    public function execute(TodoListDto $dto): TodoList
    {
        $todo_list = new TodoList();
        $todo_list->name = $dto->getName();
        $todo_list->user()->associate($dto->getUserId());
        DB::transaction(function () use ($todo_list, $dto) {
            $todo_list->save();
            foreach ($dto->getTodos() as $todoStoreDto) {
                $this->storeTodoUseCase->execute($todo_list->id, $todoStoreDto->getTitle());
            }
        });

        return $todo_list;
    }
}
