<?php
 namespace App\Services;

 use App\DTO\SearchBookDto;
 use App\Models\Book;
 use Illuminate\Database\Eloquent\Collection;

 interface BookServiceInterface
 {
     public function createBook(array $data): Book;
     public function getAllBooks(): Collection;
     public function getOneBook(int $id): ?Book;
     public function updateBook(Book $book, array $data): Book;
     public function deleteBook(Book $book): bool;
     public function getBookReviews(int $bookId, int $page = 1): ?array;
     public function searchBooks(SearchBookDTO $dto): array;
 }
