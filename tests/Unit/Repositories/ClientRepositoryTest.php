<?php

namespace Tests\Unit\Repositories;

use App\Data\Client\ClientData;
use App\Models\Client;
use App\Models\Enum\ClientEnvironment;
use App\Models\User;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Tests\TestCase;

class ClientRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_clients_paginated_method(): void
    {
        $client = Client::factory()->create();

        $clientRepository = resolve(ClientRepositoryInterface::class);
        $accessToken = Str::random(50);
        $refreshToken = Str::random(50);
        $clientRepository->storeTokens(
            client: $client,
            accessToken: $accessToken,
            refreshToken: $refreshToken,
        );
        $client->refresh();

        $this->assertEquals($client->access_token, $accessToken);
        $this->assertEquals($client->refresh_token, $refreshToken);
    }

    /** @test */
    public function store_method(): void
    {
        $clientRepository = resolve(ClientRepositoryInterface::class);
        $user = User::factory()->create();

        $name = fake()->word;
        $clientId = Str::random(50);
        $clientSecret = Str::random(50);
        $data = new ClientData(
            user: $user,
            name: $name,
            environment: ClientEnvironment::DEMO,
            clientId: $clientId,
            clientSecret: $clientSecret,
        );

        $clientRepository->store($data);

        $this->assertDatabaseCount('clients', 1);
        $this->assertDatabaseHas('clients', [
            'user_id' => $user->id,
            'name' => $name,
            'environment' => ClientEnvironment::DEMO->value,
            'client_id' => $clientId,
        ]);
        $this->assertSame(Client::first()->client_secret, $clientSecret);
    }

    /** @test */
    public function update_method(): void
    {
        $clientRepository = resolve(ClientRepositoryInterface::class);
        $user = User::factory()->create();
        $client = Client::factory(['user_id' => $user->id])->create();

        $name = fake()->word;
        $clientId = Str::random(50);
        $clientSecret = Str::random(50);
        $data = new ClientData(
            user: $user,
            name: $name,
            environment: ClientEnvironment::DEMO,
            clientId: $clientId,
            clientSecret: $clientSecret,
        );

        $clientRepository->update($client, $data);

        $this->assertDatabaseCount('clients', 1);
        $this->assertDatabaseHas('clients', [
            'user_id' => $user->id,
            'name' => $name,
            'environment' => ClientEnvironment::DEMO->value,
            'client_id' => $clientId,
        ]);
        $this->assertSame(Client::first()->client_secret, $clientSecret);
    }

    /** @test */
    public function delete_method(): void
    {
        $clientRepository = resolve(ClientRepositoryInterface::class);
        $client = Client::factory()->create();

        $clientRepository->destroy($client);

        $this->assertDatabaseCount('clients', 0);
    }
}
