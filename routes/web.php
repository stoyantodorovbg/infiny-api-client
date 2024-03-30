<?php

use App\Http\Controllers\ClientsController;
use Illuminate\Support\Facades\Route;

Route::get('/', static fn () => view('welcome'));

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Home
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Clients
    Route::prefix('clients')->group(function () {
        Route::get('/', [ClientsController::class, 'index'])->name('clients.index');
        Route::get('/create', [ClientsController::class, 'create'])->name('clients.create');
        Route::post('/store', [ClientsController::class, 'store'])->name('clients.store');
        Route::get('/edit/{client}', [ClientsController::class, 'edit'])->name('clients.edit');
        Route::put('/update/{client}', [ClientsController::class, 'update'])->name('clients.update');
        Route::delete('/delete/{client}', [ClientsController::class, 'delete'])->name('clients.delete');
    });
});
