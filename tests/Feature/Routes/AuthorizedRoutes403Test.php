<?php

namespace Tests\Feature\Routes;

use App\Models\Client;
use App\Models\Enum\ClientEnvironment;
use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthorizedRoutes403Test extends TestCase
{
    /** @test */
    public function user_can_not_edit_foreign_client(): void
    {
        $this->actingAs($this->getUser())
            ->get(route('clients.edit', $this->getClient()))
            ->assertStatus(403);
    }

    /** @test */
    public function user_can_not_update_foreign_client(): void
    {
        $this->actingAs($this->getUser())
            ->put(route('clients.update', $this->getClient()), [
                'name' => fake()->word,
                'environment' => (string) ClientEnvironment::DEMO->value,
                'client_id' => Str::random(50),
                'client_secret' => Str::random(50),
            ])
            ->assertStatus(403);
    }

    /** @test */
    public function user_can_not_delete_foreign_client(): void
    {
        $this->actingAs($this->getUser())
            ->delete(route('clients.destroy', $this->getClient()))
            ->assertStatus(403);
    }

    private function getUser(): User
    {
        return User::factory()->create();
    }

    private function getClient(): Client
    {
        return Client::factory()->create();
    }
}
