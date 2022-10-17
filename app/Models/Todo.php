<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Todo
 * @package App\Models
 * @property int $id
 * @property int $todo_list_id
 * @property TodoList $todoList
 * @property string $title
 * @property boolean $done
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Todo extends Model
{
    use HasFactory;

    public $table = "todos";

    public $fillable = [
        'title',
        'done'
    ];
    public function todoList(): BelongsTo
    {
        return $this->belongsTo(TodoList::class);
    }
}
