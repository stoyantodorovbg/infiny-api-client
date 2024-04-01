<?php

namespace Tests\Feature\Routes;

use App\Models\Client;
use App\Models\Enum\ClientEnvironment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthenticatedRoutes200RedirectResponseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function home_dashboard_returns_a_successful_response(): void
    {
        $this->actingAs($this->getUser());
        $response = $this->get(route('home.dashboard'));

        $response->assertStatus(200);
    }

    /** @test */
    public function clients_index_returns_a_successful_response(): void
    {
        $this->actingAs($this->getUser());
        $response = $this->get(route('clients.index'));

        $response->assertStatus(200);
    }

    /** @test */
    public function clients_create_returns_a_successful_response(): void
    {
        $this->actingAs($this->getUser());
        $response = $this->get(route('clients.create'));

        $response->assertStatus(200);
    }

    /** @test */
    public function clients_edit_returns_a_successful_response(): void
    {
        $user = $this->getUser();
        $this->actingAs($user);
        $client = Client::factory()->create(['user_id' => $user->id]);
        $response = $this->get(route('clients.edit', $client));

        $response->assertStatus(200);
    }

    /** @test */
    public function infiny_services_returns_a_successful_response(): void
    {
        $user = $this->getUser();
        $this->actingAs($user);
        $client = Client::factory()->create(['user_id' => $user->id]);
        Http::fake(['*' => Http::response([])]);
        $response = $this->get(route('infiny.services', $client));

        $response->assertStatus(200);
    }

    /** @test */
    public function infiny_service_details_returns_a_successful_response(): void
    {
        $user = $this->getUser();
        $this->actingAs($user);
        $client = Client::factory()->create(['user_id' => $user->id]);
        Http::fake(['*' => Http::response([])]);
        $response = $this->get(route('infiny.serviceDetails', ['client' => $client->id, 'serviceId' => 1]));

        $response->assertStatus(200);
    }

    /** @test */
    public function clients_store_returns_a_successful_response(): void
    {
        $this->actingAs($this->getUser())
            ->post(route('clients.store'), [
                'name' => fake()->word,
                'environment' => (string) ClientEnvironment::DEMO->value,
                'client_id' => Str::random(50),
                'client_secret' => Str::random(50),
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('clients.index'));
    }

    /** @test */
    public function clients_update_returns_a_successful_response(): void
    {
        $user = $this->getUser();
        $client = Client::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user)
            ->put(route('clients.update', $client), [
                'name' => fake()->word,
                'environment' => (string) ClientEnvironment::DEMO->value,
                'client_id' => Str::random(50),
                'client_secret' => Str::random(50),
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('clients.index'));
    }

    /** @test */
    public function clients_delete_returns_a_successful_response(): void
    {
        $user = $this->getUser();
        $client = Client::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user)
            ->delete(route('clients.destroy', $client))
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('clients.index'));
    }

    private function getUser(): User
    {
        return User::factory()->create();
    }
}
