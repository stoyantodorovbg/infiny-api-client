<?php

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfinyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'welcome'])->name('home.welcome');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [HomeController::class, 'home'])->name('home.dashboard');
    });

    // Clients
    Route::prefix('clients')->group(function () {
        Route::get('/', [ClientsController::class, 'index'])->name('clients.index');
        Route::get('/create', [ClientsController::class, 'create'])->name('clients.create');
        Route::post('/store', [ClientsController::class, 'store'])->name('clients.store');
        Route::get('/edit/{client}', [ClientsController::class, 'edit'])->name('clients.edit');
        Route::put('/update/{client}', [ClientsController::class, 'update'])->name('clients.update');
        Route::get('/delete/{client}', [ClientsController::class, 'delete'])->name('clients.delete');
        Route::delete('/delete´/{client}', [ClientsController::class, 'destroy'])->name('clients.destroy');
    });

    // Infiny
    Route::prefix('infiny')->group(function () {
        Route::get('/services/{client}', [InfinyController::class, 'services'])->name('infiny.services');
        Route::get('/service-details/{client}/{serviceId}', [InfinyController::class, 'serviceDetails'])->name('infiny.serviceDetails');
    });
});
