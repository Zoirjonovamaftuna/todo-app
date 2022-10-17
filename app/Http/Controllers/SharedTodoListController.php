<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoList\TodoListShareRequest;
use App\Http\Resources\TodoList\TodoListCollection;
use App\Http\Resources\TodoList\TodoListResource;
use App\Models\User;
use App\UseCases\TodoList\ShareTodoListUseCase;
use Exception;
use Illuminate\Http\Request;

class SharedTodoListController extends Controller
{
    public function getSharedTo(Request $request): TodoListCollection
    {
        /** @var User $user */
        $user = auth()->user();

        $shared_todo_lists_with_me = $user->sharedTodoListsTo;
        return new TodoListCollection($shared_todo_lists_with_me);
    }

    public function getSharedFrom(Request $request): TodoListCollection
    {
        /** @var User $user */
        $user = auth()->user();

        $shared_todo_lists_from_me = $user->sharedTodoListsFrom;
        return new TodoListCollection($shared_todo_lists_from_me);
    }

    /**
     * @throws Exception
     */
    public function share(
        TodoListShareRequest $request,
        int $todo_list_id,
        ShareTodoListUseCase $shareTodoListUseCase
    ): TodoListResource
    {
        /** @var User $user */
        $user = auth()->user();

        $shared_todo_list = $shareTodoListUseCase->execute($todo_list_id, $user->id, $request->input('to_user_id'));
        return new TodoListResource($shared_todo_list->load('todos'));
    }
}
