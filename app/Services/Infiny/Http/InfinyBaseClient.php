<?php

namespace App\Services\Infiny\Http;

use App\Models\Client;
use App\Models\Enum\ClientEnvironment;

abstract class InfinyBaseClient
{
    protected function headers(#[\SensitiveParameter] array $headers = []): array
    {
        return [...$headers, ...['Accept' => 'application/vnd.cloudlx.v1+json']];
    }

    protected function url(string $endpoint): string
    {
        return $this->getHost() . $endpoint;
    }

    protected function getHost(): string
    {
        return match ($this->getClient()->environment) {
            ClientEnvironment::DEMO => 'https://demo.infiny.cloud'
        };
    }

    /**
     * Get Client Model
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
