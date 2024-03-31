<?php

namespace App\Actions\Clients;

use App\Models\Client;
use App\Services\Infiny\Exceptions\InfinyRequestException;
use App\Services\Infiny\Interfaces\InfinyClientFactoryInterface;
use Exception;
use Lorisleiva\Actions\Concerns\AsAction;

class RequestServices
{
    use AsAction;

    public function __construct(protected InfinyClientFactoryInterface $infinyClientFactory)
    {
    }

    public function handle(Client $client): array
    {
        $infinyClient = $this->infinyClientFactory->create($client);

        try {
            $response = $infinyClient->services();
        } catch (InfinyRequestException $e) {
            return ['authentication_failure' => $e->getMessage()];
        }

        return $response->json();
    }
}
