<?php

namespace App\Services\Http\Interfaces;

use Illuminate\Http\Client\Response;

interface HttpClientInterface
{
    /**
     * Send GET request
     *
     * @param string $url
     * @param array  $parameters
     * @param array  $headers
     * @param int    $retries
     * @param int    $retryInterval
     * @return Response
     */
    public function getRequest(
        string $url,
        array $parameters = [],
        array $headers = [],
        int $retries = 1,
        int $retryInterval = 100,
    ): Response;

    /**
     * Send POST request
     *
     * @param string $url
     * @param array  $body
     * @param array  $headers
     * @param int    $retries
     * @param int    $retryInterval
     * @return Response
     */
    public function postRequest(
        string $url,
        array $body = [],
        array $headers = [],
        int $retries = 1,
        int $retryInterval = 100,
    ): Response;
}
