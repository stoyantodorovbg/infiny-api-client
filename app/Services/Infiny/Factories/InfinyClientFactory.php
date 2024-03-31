<?php

namespace App\Services\Infiny\Factories;

use App\Models\Client;
use App\Services\Http\Interfaces\HttpClientInterface;
use App\Services\Infiny\Http\InfinyHttpConnector;
use App\Services\Infiny\Http\InfinyClient;
use App\Services\Infiny\Interfaces\InfinyClientFactoryInterface;

class InfinyClientFactory implements InfinyClientFactoryInterface
{
    public function create(Client $client): InfinyClient
    {
        return new InfinyClient(new InfinyHttpConnector($client, resolve(HttpClientInterface::class)));
    }
}
