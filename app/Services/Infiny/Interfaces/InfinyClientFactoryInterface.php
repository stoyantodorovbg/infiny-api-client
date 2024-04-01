<?php

namespace App\Services\Infiny\Interfaces;

use App\Models\Client;

interface InfinyClientFactoryInterface
{
    /**
     * Create Infiny client by given Client Model
     *
     * @param Client $client
     * @return InfinyClientInterface
     */
    public function create(Client $client): InfinyClientInterface;
}
