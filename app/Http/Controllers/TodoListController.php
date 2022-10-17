<?php

namespace App\Http\Controllers;

use App\DTO\TodoListDto;
use App\Http\Requests\TodoList\TodoListEditRequest;
use App\Http\Requests\TodoList\TodoListStoreRequest;
use App\Http\Resources\TodoList\TodoListCollection;
use App\Http\Resources\TodoList\TodoListResource;
use App\Models\TodoList;
use App\Models\User;
use App\Tasks\TodoList\FindTodoListByUserTask;
use App\UseCases\TodoList\DeleteTodoListUseCase;
use App\UseCases\TodoList\EditTodoListUseCase;
use App\UseCases\TodoList\StoreTodoListUseCase;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    /**
     * @param Request $request
     * @return TodoListCollection
     */
    public function index(Request $request): TodoListCollection
    {
        /** @var User $user */
        $user = auth()->user();

        $todo_lists = TodoList::query()
            ->where('user_id', $user->id)
            ->with(['todos'])
            ->get();

        return new TodoListCollection($todo_lists);
    }

    /**
     * @param int $todo_list_id
     * @param FindTodoListByUserTask $findTodoListByUserTask
     * @return TodoListResource
     * @throws Exception
     */
    public function show(int $todo_list_id, FindTodoListByUserTask $findTodoListByUserTask): TodoListResource
    {
        /** @var User $user */
        $user = auth()->user();

        $todo_list = $findTodoListByUserTask->execute($todo_list_id, $user->id);
        return new TodoListResource($todo_list->load('todos'));
    }

    /**
     * @param TodoListStoreRequest $request
     * @param StoreTodoListUseCase $storeTodoListUseCase
     * @return TodoListResource
     */
    public function store(TodoListStoreRequest $request, StoreTodoListUseCase $storeTodoListUseCase): TodoListResource
    {
        /** @var User $user */
        $user = auth()->user();

        $todo_list = $storeTodoListUseCase->execute(TodoListDto::fromArray([
            'name' => $request->input('name'),
            'user_id' => $user->id,
            'todos' => $request->input('todos')
        ]));

        return new TodoListResource($todo_list->load('todos'));
    }

    /**
     * @param TodoListEditRequest $request
     * @param $todo_list_id
     * @param EditTodoListUseCase $editTodoListUseCase
     * @return TodoListResource
     * @throws Exception
     */
    public function edit(TodoListEditRequest $request, $todo_list_id, EditTodoListUseCase $editTodoListUseCase): TodoListResource
    {
        /** @var User $user */
        $user = auth()->user();
        $todo_list = $editTodoListUseCase->execute($todo_list_id, $user->id, $request->input('name'));
        return new TodoListResource($todo_list->load('todos'));
    }

    /**
     * @throws Exception
     */
    public function delete(int $todo_list_id, DeleteTodoListUseCase $deleteTodoListUseCase): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $deleteTodoListUseCase->execute($todo_list_id, $user->id);

        return new JsonResponse(["message" => "Todo List deleted"]);
    }
}
