<?php

namespace Tests\Feature\Routes;

use App\Models\Client;
use App\Models\Enum\ClientEnvironment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthenticatedRoutesRedirectLoginTest extends TestCase
{
    /** @test */
    public function home_dashboard_returns_a_successful_response(): void
    {
        $response = $this->get(route('home.dashboard'));
        $response->assertRedirect('login');
    }

    /** @test */
    public function clients_index_returns_a_successful_response(): void
    {
        $response = $this->get(route('clients.index'));
        $response->assertRedirect('login');
    }

    /** @test */
    public function clients_create_returns_a_successful_response(): void
    {
        $response = $this->get(route('clients.create'));
        $response->assertRedirect('login');
    }

    /** @test */
    public function clients_edit_returns_a_successful_response(): void
    {
        $response = $this->get(route('clients.edit', Client::factory()->create()));
        $response->assertRedirect('login');
    }

    /** @test */
    public function infiny_services_returns_a_successful_response(): void
    {
        $client = Client::factory()->create();
        Http::fake(['*' => Http::response([])]);
        $response = $this->get(route('infiny.services', $client));

        $response->assertRedirect('login');
    }

    /** @test */
    public function infiny_service_details_returns_a_successful_response(): void
    {
        $client = Client::factory()->create();
        Http::fake(['*' => Http::response([])]);
        $response = $this->get(route('infiny.serviceDetails', ['client' => $client->id, 'serviceId' => 1]));
        $response->assertRedirect('login');
    }

    /** @test */
    public function clients_store_returns_a_successful_response(): void
    {
        $this->post(route('clients.store'), [
            'name' => fake()->word,
            'environment' => (string) ClientEnvironment::DEMO->value,
            'client_id' => Str::random(50),
            'client_secret' => Str::random(50),
        ])
        ->assertRedirect(route('login'));
    }

    /** @test */
    public function clients_update_returns_a_successful_response(): void
    {
        $client = Client::factory()->create();
        $this->put(route('clients.update', $client), [
                'name' => fake()->word,
                'environment' => (string) ClientEnvironment::DEMO->value,
                'client_id' => Str::random(50),
                'client_secret' => Str::random(50),
            ])
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function clients_delete_returns_a_successful_response(): void
    {
        $client = Client::factory()->create();
        $this->delete(route('clients.destroy', $client))
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('login'));
    }
}
