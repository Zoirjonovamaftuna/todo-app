<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class TodoList
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property User $user
 * @property Todo $todos
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class TodoList extends Model
{
    use HasFactory;

    public $table = 'todo_lists';

    public $fillable = [
        'name'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function todos(): HasMany
    {
        return $this->hasMany(Todo::class);
    }
}
