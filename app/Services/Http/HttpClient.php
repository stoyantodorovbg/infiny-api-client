<?php

namespace App\Services\Http;

use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

abstract class HttpClient
{
    protected function getRequest(
        string $endpoint,
        array $parameters = [],
        array $headers = [],
        int $retries = 1,
        int $retryInterval = 100,
    ): Response
    {
        list($parameters, $headers, $url) = $this->queryData($parameters, $headers, $endpoint);

        try {
            return Http::retry($retries, $retryInterval)
                ->withHeaders($headers)
                ->withUserAgent(config('app.name'))
                ->get($url, $parameters)
                ->throw();
        } catch (RequestException $exception) {
            $this->processRequestException($exception, "Failed HTTP GET request to {$url}");
        }
    }

    protected function postRequest(
        string $endpoint,
        array $parameters = [],
        array $headers = [],
        int $retries = 1,
        int $retryInterval = 100,
    ): Response
    {
        list($parameters, $headers, $url) = $this->queryData($parameters, $headers, $endpoint);

        try {
            return Http::asForm()
                ->retry($retries, $retryInterval)
                ->withHeaders($headers)
                ->withUserAgent(config('app.name'))
                ->post($url, $parameters)
                ->throw();
        } catch (RequestException $exception) {
            $this->processRequestException($exception, "Failed HTTP POST form request to {$url}");
        }
    }

    protected function queryData(array $parameters, array $headers, string $endpoint): array
    {
        $parameters = [...$this->baseParameters(), ...$parameters,];
        $headers = [...$this->baseHeaders(), ...$headers,];
        $url = $this->url($endpoint);

        return [$parameters, $headers, $url];
    }

    protected function processRequestException(RequestException $exception, string $message): Response
    {
        Log::critical($message);
        Log::critical($exception->response->body());

        return $exception->response;
    }

    protected function baseParameters(): array
    {
        return [];
    }

    protected function baseHeaders(): array
    {
        return [];
    }

    protected function url(string $endpoint): string
    {
        return $this->getHost() . $endpoint;
    }

    abstract protected function getHost(): string;
}
