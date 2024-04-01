<?php

namespace Tests\Unit\Repositories;

use App\Models\Client;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_clients_paginated_method()
    {
        $user = User::factory()->create();
        $clientsCount = 3;
        Client::factory(['user_id' => $user->id])->count($clientsCount)->create();

        $userRepository = resolve(UserRepositoryInterface::class);
        $paginator = $userRepository->userClientsPaginated($user);
        $this->assertEquals($paginator->total(), $clientsCount);

        Client::factory()->create();
        $this->assertEquals($paginator->total(), $clientsCount);
    }
}
