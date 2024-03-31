<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;

class ClientRepository extends Repository implements ClientRepositoryInterface
{
    protected string $model = Client::class;

    public function storeTokens(
        Client $client,
        #[\SensitiveParameter]
        string $accessToken,
        #[\SensitiveParameter]
        string $refreshToken
    ): void
    {
        $client->access_token = $accessToken;
        $client->refresh_token = $refreshToken;

        $client->save();
    }
}
