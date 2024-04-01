<?php

namespace App\Services\Infiny\Interfaces;

use App\Models\Client;
use App\Services\Infiny\Http\InfinyClient;

interface InfinyClientFactoryInterface
{
    /**
     * Create Infiny client by given Client Model
     *
     * @param Client $client
     * @return InfinyClient
     */
    public function create(Client $client): InfinyClient;
}
