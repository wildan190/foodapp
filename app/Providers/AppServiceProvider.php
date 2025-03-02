<?php

namespace App\Providers;

use App\Domain\Permissions\Infrastructure\PermissionsRepository;
use App\Domain\Roles\Infrastructure\RolesRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\Interface\CustomerRepositoryInterface;
use App\Repositories\Interface\MenuRepositoryInterface;
use App\Repositories\Interface\PermissionsRepositoryInterface;
use App\Repositories\Interface\RolesRepositoryInterface;
use App\Repositories\Interface\SalesRepositoryInterface;
use App\Repositories\Interface\SupplierRepositoryInterface;
use App\Repositories\Interface\TransactionRepositoryInterface;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Repositories\MenuRepository;
use App\Repositories\SalesRepository;
use App\Repositories\SupplierRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(RolesRepositoryInterface::class, RolesRepository::class);
        $this->app->bind(PermissionsRepositoryInterface::class, PermissionsRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
