<?php

namespace App\Providers;

use App\Repositories\BookRepository;
use App\Repositories\BookRepositoryInterface;
use App\Services\BookService;
use App\Services\BookServiceInterface;
use App\Services\CalculatorService;
use App\Services\CalculatorServiceInterface;
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
    }

    public function boot(): void
    {
        //
    }
}
