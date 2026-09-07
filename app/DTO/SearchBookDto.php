<?php

namespace App\DTO;
readonly class SearchBookDto

{
    public function __construct(
        private ?string $title,
        private ?string $author,
        private ?float  $minRating,
        private string $sortBy = 'title',
        private string $order = 'asc',
    ) {

    }
    public function getTitle(): ?string
    {
        return $this->title;
    }
    public function getAuthor(): ?string
    {
        return $this->author;
    }
    public function getMinRating(): ?float
    {
        return $this->minRating;
    }
    public function getSortBy(): string
    {
        return $this->sortBy;
    }
    public function getOrder(): string
    {
        return $this->order;
    }
}
