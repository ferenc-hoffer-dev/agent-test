<?php

namespace App\Repositories;

use App\DTO\SearchBookDTO;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

interface BookRepositoryInterface
{
    public function create(array $data): Book;
    public function getAll(): Collection;
    public function getById(int $id): ?Book;
    public function update(Book $book, array $data): Book;
    public function delete(Book $book): bool;
    public function getReviews(int $bookId, int $page = 1): ?array;
    public function search(SearchBookDto $dto): Collection;
}
