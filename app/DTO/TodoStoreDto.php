<?php

namespace App\DTO;

final class TodoStoreDto
{
    public function __construct(
        private string $title,
    )
    {
    }

    public static function fromArray(array $data): static
    {
        return new static(
            title: $data['title'],
        );
    }

    public function jsonSerialize(): array
    {
        return [
            'title' => $this->title,
        ];
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

}
