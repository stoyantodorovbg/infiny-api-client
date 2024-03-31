<?php

namespace App\Data\Client;

use App\Data\Interfaces\MassStore;
use App\Data\Interfaces\MassUpdate;
use App\Models\User;
use SensitiveParameter;
use Spatie\LaravelData\Data;

class ClientData extends Data implements MassStore, MassUpdate
{
    public function __construct(
        public User $user,
        public string $name,
        public string $clientId,
        #[SensitiveParameter]
        public string $clientSecret,
        #[SensitiveParameter]
        public string|null $accessToken = null,
        #[SensitiveParameter]
        public string|null $refreshToken = null,
    )
    {
    }

    public function massStoreFormat(): array
    {
        return [
            'user_id' => $this->user->id,
            'name' => $this->name,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];
    }

    public function massUpdateFormat(): array
    {
        return [
            'name' => $this->name,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];
    }
}
