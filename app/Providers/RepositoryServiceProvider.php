<?php

namespace App\Providers;

use App\Repositories\ClientRepository;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
    }
}
