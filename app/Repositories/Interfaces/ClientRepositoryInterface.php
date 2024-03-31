<?php

namespace App\Repositories\Interfaces;

use App\Models\Client;

interface ClientRepositoryInterface extends RepositoryInterface
{
    /**
     * Store Client tokens
     *
     * @param Client $client
     * @param string $accessToken
     * @param string $refreshToken
     * @return void
     */
    public function storeTokens(
        Client $client,
        #[\SensitiveParameter]
        string $accessToken,
        #[\SensitiveParameter]
        string $refreshToken
    ): void;
}
