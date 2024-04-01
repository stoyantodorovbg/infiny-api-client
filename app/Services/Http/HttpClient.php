<?php

namespace App\Services\Http;

use App\Services\Http\Interfaces\HttpClientInterface;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HttpClient implements HttpClientInterface
{
    public function getRequest(
        string $url,
        array $parameters = [],
        #[\SensitiveParameter]
        array $headers = [],
        int $retries = 1,
        int $retryInterval = 1000,
    ): Response
    {
        try {
            return Http::retry($retries, $retryInterval)
                ->withHeaders($headers)
                ->withUserAgent(config('app.name'))
                ->get($url, $parameters)
                ->throw();
        } catch (RequestException $exception) {
            $this->processRequestException($exception, "Failed HTTP GET request to {$url}");

            return $exception->response;
        }
    }

    public function postRequest(
        string $url,
        array $body = [],
        #[\SensitiveParameter]
        array $headers = [],
        int $retries = 1,
        int $retryInterval = 1000,
    ): Response
    {
        try {
            return Http::retry($retries, $retryInterval)
                ->withHeaders($headers)
                ->withUserAgent(config('app.name'))
                ->post($url, $body)
                ->throw();
        } catch (RequestException $exception) {
            $this->processRequestException($exception, "Failed HTTP POST request to {$url}");

            return $exception->response;
        }
    }

    protected function processRequestException(RequestException $exception, string $message): Response
    {
        Log::critical($message);
        Log::critical($exception->response->body());

        return $exception->response;
    }
}
