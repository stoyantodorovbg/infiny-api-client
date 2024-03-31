<?php

namespace App\Services\Infiny\Http;

use App\Models\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Services\Http\Interfaces\HttpClientInterface;
use App\Services\Http\Interfaces\HttpClientConnector;
use App\Services\TTLock\Exceptions\InfinyRequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;

class InfinyHttpConnector extends InfinyBaseClient implements HttpClientConnector
{
    protected string|null $accessToken;

    public function __construct(protected Client $client, protected HttpClientInterface $httpClient)
    {
    }

    public function getHttpClient(): HttpClientInterface
    {
        return $this->httpClient;
    }

    /**
     * @throws InfinyRequestException
     */
    public function accessToken(bool $refresh = false): string
    {
        if ($refresh) {
            return $this->refreshAccessToken();
        }

        if (! $this->accessToken) {
            return $this->getAccessToken();
        }

        return $this->accessToken;
    }

    protected function getClient(): Client
    {
        return $this->client;
    }

    /**
     * Request access token
     *
     * @return string
     * @throws InfinyRequestException
     */
    protected function getAccessToken(): string
    {
        $body = $this->requestBody(['grant_type' => 'client_credentials']);
        $response = $this->tokenRequest($this->url('/api/oauth2/access-token'), $body);
        if ($response->ok()) {
            return $this->processSuccessResponse($response);
        }

        $this->logCritical("Can't receive access token.");
        $this->throwException();
    }

    /**
     * @throws InfinyRequestException
     */
    protected function refreshAccessToken(): string
    {
        $body = $this->requestBody([
            'refresh_token' => $this->client->refresh_token,
            'grant_type' => 'refresh_token'
        ]);

        $response = $this->tokenRequest($this->url('/api/oauth2/refresh-token'), $body);
        if ($response->ok()) {
            return $this->processSuccessResponse($response);
        }

        $this->logCritical("Can't refresh access token.");
        $this->throwException();
    }

    protected function requestBody(array $body): array
    {
        return [...$body, ...[
                'client_id' => $this->client->client_id,
                'client_secret' => $this->client->client_secret,
            ]
        ];
    }

    /**
     * Send request to get access token
     *
     * @param string $endpoint
     * @param array  $body
     * @return Response
     */
    protected function tokenRequest(string $endpoint, array $body): Response
    {
        return $this->httpClient->postRequest(
            url: $this->url($endpoint),
            body: $body,
            headers: $this->headers(),
            retries: 3,
        );
    }

    protected function processSuccessResponse(Response $response): string
    {
        $responseBody = $response->json();
        resolve(ClientRepositoryInterface::class)->storeTokens(
            client: $this->client,
            accessToken: $responseBody['access_token'],
            refreshToken: $responseBody['refresh_token'],
        );
        $this->accessToken = $responseBody['access_token'];

        return $this->accessToken;
    }

    protected function logCritical(string $message): void
    {
        Log::critical("Infiny client {$this->client->id} failed: {$message}");
    }

    /**
     * @throws InfinyRequestException
     */
    protected function throwException(): never
    {
        throw new InfinyRequestException("Can't authenticate.");
    }
}
