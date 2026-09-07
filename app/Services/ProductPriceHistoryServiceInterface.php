<?php

namespace App\Services;

use App\Models\ProductPriceHistory;
use Illuminate\Database\Eloquent\Collection;

interface ProductPriceHistoryServiceInterface
{
    public function addPriceHistory(array $data): ProductPriceHistory;
    public function getLatestPrice(int $productId): ?ProductPriceHistory;
    public function getPriceHistory(int $productId): Collection;
}