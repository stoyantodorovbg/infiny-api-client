<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;

class ClientPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Client $client): bool
    {
        return $this->clientBelongsToUser($user, $client);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Client $client): bool
    {
        return $this->clientBelongsToUser($user, $client);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Client $client): bool
    {
        return $this->clientBelongsToUser($user, $client);
    }

    private function clientBelongsToUser(User $user, Client $client): bool
    {
        return $user->id === $client->user_id;
    }
}
