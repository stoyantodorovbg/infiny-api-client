<?php

namespace App\Providers;

use App\Services\Http\HttpClient;
use App\Services\Http\Interfaces\HttpClientInterface;
use App\Services\Infiny\Factories\InfinyClientFactory;
use App\Services\Infiny\Interfaces\InfinyClientFactoryInterface;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
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
        $this->app->bind(HttpClientInterface::class, HttpClient::class);
        $this->app->bind(InfinyClientFactoryInterface::class, InfinyClientFactory::class);
    }
}
