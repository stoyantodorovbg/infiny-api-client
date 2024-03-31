<?php

namespace App\Services\Http\Interfaces;

interface HttpClientConnector
{
    /**
     * Get HTTP Client instance
     *
     * @return HttpClientInterface
     */
    public function getHttpClient(): HttpClientInterface;

    /**
     * Get access token
     *
     * @param bool $refresh
     * @return string
     */
    public function accessToken(bool $refresh = false): string;
}
