<?php

namespace App\Services\Infiny\Http;

use App\Models\Client;
use App\Models\Enum\ClientEnvironment;

abstract class InfinyBaseClient
{
    /**
     * Prepare headers
     *
     * @param array $headers
     * @return array
     */
    protected function headers(#[\SensitiveParameter] array $headers = []): array
    {
        return [...$headers, ...[
            'Accept' => 'application/vnd.cloudlx.v1+json',
            'Content-Type' => 'application/json',
        ]];
    }

    /**
     * Prepare url
     *
     * @param string $endpoint
     * @return string
     */
    protected function url(string $endpoint): string
    {
        return $this->getHost() . $endpoint;
    }

    /**
     * Get host
     *
     * @return string
     */
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
