<?php

namespace App\Repositories;

use App\Models\ProductPriceHistory;
use Illuminate\Database\Eloquent\Collection;

class ProductPriceHistoryRepository implements ProductPriceHistoryRepositoryInterface
{
    public function create(array $data): ProductPriceHistory
    {
        return ProductPriceHistory::create($data);
    }

    public function getLatestByProductId(int $productId): ?ProductPriceHistory
    {
        return ProductPriceHistory::query()
            ->where('product_id', $productId)
            ->orderByDesc('effective_at')
            ->first();
    }

    public function getByProductId(int $productId): Collection
    {
        return ProductPriceHistory::query()
            ->where('product_id', $productId)
            ->orderByDesc('effective_at')
            ->get();
    }
}