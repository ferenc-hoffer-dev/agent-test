<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\ProductPriceHistory;
use App\Services\ProductPriceHistoryService;
use App\Services\ProductPriceHistoryServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use Tests\TestCase;

class ProductPriceHistoryServiceTest extends TestCase
{
    use RefreshDatabase;

    private ProductPriceHistoryService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new ProductPriceHistoryService(
            app(\App\Repositories\ProductPriceHistoryRepositoryInterface::class),
        );
    }

    public function test_can_add_price_history_record(): void
    {
        $product = Product::create([
            'name' => 'Widget',
            'price' => 9.99,
            'description' => 'A widget',
        ]);

        $record = $this->service->addPriceHistory([
            'product_id' => $product->id,
            'price' => 19.99,
            'currency' => 'USD',
            'effective_at' => '2026-01-15 10:00:00',
        ]);

        $this->assertInstanceOf(ProductPriceHistory::class, $record);
        $this->assertEquals(19.99, $record->price);
        $this->assertEquals('USD', $record->currency);
        $this->assertEquals($product->id, $record->product_id);
        $this->assertDatabaseHas('product_price_histories', [
            'product_id' => $product->id,
            'price' => 19.99,
            'currency' => 'USD',
        ]);
    }

    public function test_can_retrieve_latest_price(): void
    {
        $product = Product::create([
            'name' => 'Widget',
            'price' => 9.99,
        ]);

        $this->service->addPriceHistory([
            'product_id' => $product->id,
            'price' => 10.00,
            'currency' => 'USD',
            'effective_at' => '2026-01-10 10:00:00',
        ]);

        $latest = $this->service->addPriceHistory([
            'product_id' => $product->id,
            'price' => 12.50,
            'currency' => 'USD',
            'effective_at' => '2026-02-15 10:00:00',
        ]);

        $result = $this->service->getLatestPrice($product->id);

        $this->assertNotNull($result);
        $this->assertEquals($latest->id, $result->id);
        $this->assertEquals(12.50, $result->price);
    }

    public function test_can_retrieve_price_history_ordered_by_effective_date_desc(): void
    {
        $product = Product::create([
            'name' => 'Widget',
            'price' => 9.99,
        ]);

        $old = $this->service->addPriceHistory([
            'product_id' => $product->id,
            'price' => 10.00,
            'currency' => 'USD',
            'effective_at' => '2026-01-10 10:00:00',
        ]);

        $middle = $this->service->addPriceHistory([
            'product_id' => $product->id,
            'price' => 11.00,
            'currency' => 'USD',
            'effective_at' => '2026-02-10 10:00:00',
        ]);

        $newest = $this->service->addPriceHistory([
            'product_id' => $product->id,
            'price' => 12.00,
            'currency' => 'USD',
            'effective_at' => '2026-03-10 10:00:00',
        ]);

        $history = $this->service->getPriceHistory($product->id);

        $this->assertCount(3, $history);
        $this->assertEquals($newest->id, $history[0]->id);
        $this->assertEquals($middle->id, $history[1]->id);
        $this->assertEquals($old->id, $history[2]->id);
    }

    public function test_negative_price_is_rejected(): void
    {
        $product = Product::create([
            'name' => 'Widget',
            'price' => 9.99,
        ]);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Price cannot be negative.');

        $this->service->addPriceHistory([
            'product_id' => $product->id,
            'price' => -5.00,
            'currency' => 'USD',
            'effective_at' => '2026-01-15 10:00:00',
        ]);
    }

    public function test_throws_exception_when_product_does_not_exist_on_add(): void
    {
        $this->expectException(ModelNotFoundException::class);

        $this->service->addPriceHistory([
            'product_id' => 9999,
            'price' => 10.00,
            'currency' => 'USD',
            'effective_at' => '2026-01-15 10:00:00',
        ]);
    }

    public function test_throws_exception_when_product_does_not_exist_on_get_latest(): void
    {
        $this->expectException(ModelNotFoundException::class);

        $this->service->getLatestPrice(9999);
    }

    public function test_throws_exception_when_product_does_not_exist_on_get_history(): void
    {
        $this->expectException(ModelNotFoundException::class);

        $this->service->getPriceHistory(9999);
    }

    public function test_returns_null_when_product_has_no_price_history(): void
    {
        $product = Product::create([
            'name' => 'Widget',
            'price' => 9.99,
        ]);

        $latest = $this->service->getLatestPrice($product->id);
        $this->assertNull($latest);

        $history = $this->service->getPriceHistory($product->id);
        $this->assertCount(0, $history);
    }

    public function test_service_is_bound_in_container(): void
    {
        $service = $this->app->make(ProductPriceHistoryServiceInterface::class);
        $this->assertInstanceOf(ProductPriceHistoryService::class, $service);
    }
}