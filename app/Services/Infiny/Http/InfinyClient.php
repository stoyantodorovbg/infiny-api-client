<?php

namespace App\Services\Infiny\Http;

use App\Models\Client;
use App\Services\Http\Interfaces\HttpClientConnector;
use App\Services\Infiny\Interfaces\InfinyClientInterface;
use Illuminate\Http\Client\Response;

class InfinyClient extends InfinyBaseClient implements InfinyClientInterface
{
    public function __construct(protected HttpClientConnector $httpConnector)
    {
    }

    public function services(): Response
    {
        return $this->assureAuthorizedGet($this->url('/api/services'));
    }

    public function serviceDetails(int $serviceId): Response
    {
        return $this->assureAuthorizedGet($this->url("/api/services/{$serviceId}/service"));
    }

    protected function assureAuthorizedGet(string $url, array $parameters = []): Response
    {
        $response = $this->sendGetRequest(url: $url);
        if ($response->status() === 401) {
            $response = $this->sendGetRequest(url: $url, refreshToken: true);
        }

        return $response;
    }

    protected function sendGetRequest(string $url, array $parameters = [], bool $refreshToken = false): Response
    {
        return $this->httpConnector->getHttpClient()->getRequest(
            url: $url,
            parameters: $parameters,
            headers: $this->headers(['Authorization' => $this->httpConnector->accessToken($refreshToken)]),
            retries: 2,
        );
    }

    protected function getClient(): Client
    {
        return $this->httpConnector->getClient();
    }
}
