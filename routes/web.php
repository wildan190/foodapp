<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Rute untuk autentikasi
Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
});

// Rute yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute Customer
    Route::prefix('customers')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('/create', [CustomerController::class, 'create'])->name('customers.create');
        Route::post('/', [CustomerController::class, 'store'])->name('customers.store');
        Route::get('/{id}', [CustomerController::class, 'show'])->name('customers.show');
        Route::get('/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
        Route::put('/{id}', [CustomerController::class, 'update'])->name('customers.update');
        Route::delete('/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    });

    // Rute Supplier
    Route::prefix('suppliers')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('suppliers.index');
        Route::get('/create', [SupplierController::class, 'create'])->name('suppliers.create');
        Route::post('/', [SupplierController::class, 'store'])->name('suppliers.store');
        Route::get('/{id}', [SupplierController::class, 'show'])->name('suppliers.show');
        Route::get('/{id}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
        Route::put('/{id}', [SupplierController::class, 'update'])->name('suppliers.update');
        Route::delete('/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
    });

    // Rute Menu
    Route::prefix('menus')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('menus.index');
        Route::get('/create', [MenuController::class, 'create'])->name('menus.create');
        Route::post('/', [MenuController::class, 'store'])->name('menus.store');
        Route::get('/{id}', [MenuController::class, 'show'])->name('menus.show');
        Route::get('/{id}/edit', [MenuController::class, 'edit'])->name('menus.edit');
        Route::put('/{id}', [MenuController::class, 'update'])->name('menus.update');
        Route::delete('/{id}', [MenuController::class, 'destroy'])->name('menus.destroy');
    });

    // Rute Sales
    Route::prefix('sales')->group(function () {
        Route::get('/', [SalesController::class, 'index'])->name('sales.index');
        Route::get('/create', [SalesController::class, 'create'])->name('sales.create');
        Route::post('/', [SalesController::class, 'store'])->name('sales.store');
        Route::get('/{id}', [SalesController::class, 'show'])->name('sales.show');
        Route::get('/{id}/edit', [SalesController::class, 'edit'])->name('sales.edit');
        Route::put('/{id}', [SalesController::class, 'update'])->name('sales.update');
        Route::delete('/{id}', [SalesController::class, 'destroy'])->name('sales.destroy');
    });

    // Rute Transactions
    Route::prefix('transactions')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/create', [TransactionController::class, 'create'])->name('transactions.create');
        Route::post('/', [TransactionController::class, 'store'])->name('transactions.store');
        Route::get('/{id}', [TransactionController::class, 'show'])->name('transactions.show');
        Route::delete('/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
        Route::get('/{id}/print-invoice', [TransactionController::class, 'printInvoice'])->name('transactions.printInvoice');
    });
});
