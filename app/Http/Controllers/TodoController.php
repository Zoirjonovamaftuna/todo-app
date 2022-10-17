<?php

namespace App\Http\Controllers;

use App\Http\Requests\Todo\TodoEditRequest;
use App\Http\Requests\Todo\TodoStoreRequest;
use App\Http\Resources\Todo\TodoResource;
use App\Models\User;
use App\Tasks\TodoList\FindTodoListByUserTask;
use App\UseCases\Todo\DeleteTodoUseCase;
use App\UseCases\Todo\EditTodoUseCase;
use App\UseCases\Todo\StoreTodoUseCase;
use Exception;
use Illuminate\Http\JsonResponse;

class TodoController extends Controller
{
    public function store(
        TodoStoreRequest $request,
        int $todo_list_id,
        FindTodoListByUserTask $findTodoListByUserTask,
        StoreTodoUseCase $storeTodoUseCase
    ): TodoResource
    {
        /** @var User $user */
        $user = auth()->user();

        $todo_list = $findTodoListByUserTask->execute($todo_list_id, $user->id);
        $todo = $storeTodoUseCase->execute($todo_list->id, $request->input('title'));

        return new TodoResource($todo);
    }

    /**
     * @throws Exception
     */
    public function edit(
        TodoEditRequest $request,
        int $todo_list_id,
        int $todo_id,
        FindTodoListByUserTask $findTodoListByUserTask,
        EditTodoUseCase $editTodoUseCase
    ): TodoResource
    {
        /** @var User $user */
        $user = auth()->user();

        $todo_list = $findTodoListByUserTask->execute($todo_list_id, $user->id);
        $todo = $editTodoUseCase->execute($todo_list->id, $todo_id, $request->input('title'));
        return new TodoResource($todo);
    }

    /**
     * @throws Exception
     */
    public function delete(
        int $todo_list_id,
        int $todo_id,
        DeleteTodoUseCase $deleteTodoUseCase
    ): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $deleteTodoUseCase->execute($todo_list_id, $todo_id, $user->id);
        return new JsonResponse(["message" => "Todo deleted"]);
    }
}
