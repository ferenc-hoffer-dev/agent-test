<?php

namespace App\Providers;

use App\Repositories\BookRepository;
use App\Repositories\BookRepositoryInterface;
use App\Repositories\ProductPriceHistoryRepository;
use App\Repositories\ProductPriceHistoryRepositoryInterface;
use App\Services\BookService;
use App\Services\BookServiceInterface;
use App\Services\CalculatorService;
use App\Services\CalculatorServiceInterface;
use App\Services\ProductPriceHistoryService;
use App\Services\ProductPriceHistoryServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            BookRepositoryInterface::class,
            BookRepository::class
        );

        $this->app->bind(
            BookServiceInterface::class,
            BookService::class
        );

        $this->app->bind(
            CalculatorServiceInterface::class,
            CalculatorService::class
        );

        $this->app->bind(
            ProductPriceHistoryRepositoryInterface::class,
            ProductPriceHistoryRepository::class
        );

        $this->app->bind(
            ProductPriceHistoryServiceInterface::class,
            ProductPriceHistoryService::class
        );
    }

    public function boot(): void
    {
        //
    }
}
