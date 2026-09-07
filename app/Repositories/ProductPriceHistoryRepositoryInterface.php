<?php

namespace App\Repositories;

use App\Models\ProductPriceHistory;
use Illuminate\Database\Eloquent\Collection;

interface ProductPriceHistoryRepositoryInterface
{
    public function create(array $data): ProductPriceHistory;
    public function getLatestByProductId(int $productId): ?ProductPriceHistory;
    public function getByProductId(int $productId): Collection;
}