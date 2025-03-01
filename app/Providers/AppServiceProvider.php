<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interface\CustomerRepositoryInterface;
use App\Repositories\CustomerRepository;
use App\Repositories\Interface\SupplierRepositoryInterface;
use App\Repositories\SupplierRepository;
use App\Repositories\Interface\MenuRepositoryInterface;
use App\Repositories\MenuRepository;
use App\Repositories\Interface\SalesRepositoryInterface;
use App\Repositories\SalesRepository;
use App\Repositories\Interface\TransactionRepositoryInterface;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\Repositories\Interface\UserRepositoryInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
        $this->app->bind(MenuRepositoryInterface::class, MenuRepository::class);
        $this->app->bind(SalesRepositoryInterface::class, SalesRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
