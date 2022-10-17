<?php

namespace App\DTO;

final class TodoListDto
{
    public function __construct(
        private string $name,
        private int    $user_id,
        private array  $todos
    )
    {
    }

    public static function fromArray(array $data): static
    {
        return new static(
            name: $data['name'],
            user_id: $data['user_id'],
            todos: array_map(function ($todos) {
                return TodoStoreDto::fromArray($todos);
            }, $data['todos'])

        );
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'user_id' => $this->user_id,
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return TodoStoreDto[]
     */
    public function getTodos(): array
    {
        return $this->todos;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }
}
