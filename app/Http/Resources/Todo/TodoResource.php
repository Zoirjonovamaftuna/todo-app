<?php

namespace App\Http\Resources\Todo;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class TodoResource
 * @package App\Http\Resources
 * @property Todo $resource
 */
class TodoResource extends JsonResource
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
            'todo_list_id' => $this->resource->todo_list_id,
            'title' => $this->resource->title,
            'done' => $this->resource->done,
            'created_at' => $this->resource->created_at,
        ];
    }
}
