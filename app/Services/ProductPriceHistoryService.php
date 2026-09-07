<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductPriceHistory;
use App\Repositories\ProductPriceHistoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use InvalidArgumentException;

readonly class ProductPriceHistoryService implements ProductPriceHistoryServiceInterface
{
    public function __construct(
        private ProductPriceHistoryRepositoryInterface $repository,
    ) {}

    public function addPriceHistory(array $data): ProductPriceHistory
    {
        if ($data['price'] < 0) {
            throw new InvalidArgumentException('Price cannot be negative.');
        }

        $product = Product::find($data['product_id']);
        if (!$product) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
        }

        return $this->repository->create($data);
    }

    public function getLatestPrice(int $productId): ?ProductPriceHistory
    {
        $product = Product::find($productId);
        if (!$product) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
        }

        return $this->repository->getLatestByProductId($productId);
    }

    public function getPriceHistory(int $productId): Collection
    {
        $product = Product::find($productId);
        if (!$product) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
        }

        return $this->repository->getByProductId($productId);
    }
}