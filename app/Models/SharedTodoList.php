<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SharedTodoList
 * @package App\Models
 * @property int $id
 * @property int $from_user_id
 * @property int $to_user_id
 * @property int $todo_list_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User $toUser
 * @property User $fromUser
 * @property TodoList $todoList
 */
class SharedTodoList extends Model
{
    use HasFactory;

    public $table = "shared_todo_lists";

    public function toUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to_user_id', 'id');
    }

    public function fromUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_user_id', 'id');
    }

    public function todoList(): BelongsTo
    {
        return $this->belongsTo(TodoList::class);
    }
}
