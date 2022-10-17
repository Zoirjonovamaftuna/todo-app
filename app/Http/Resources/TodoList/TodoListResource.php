<?php

namespace App\Http\Resources\TodoList;

use App\Http\Resources\Todo\TodoCollection;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class StoreTodoListResource
 * @package App\Http\Resources
 * @property TodoList $resource
 */
class TodoListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'user_id' => $this->resource->user_id,
            'created_at' => $this->resource->created_at,
            'todos' => new TodoCollection($this->whenLoaded('todos'))
        ];
    }
}
