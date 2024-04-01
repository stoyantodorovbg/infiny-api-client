<?php

namespace Tests\Unit\InfinyService;

use App\Models\Client;
use App\Services\Http\Interfaces\HttpClientConnector;
use App\Services\Http\Interfaces\HttpClientInterface;
use App\Services\Infiny\Exceptions\InfinyRequestException;
use App\Services\Infiny\Http\InfinyHttpConnector;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class InfinyHttpConnectorTest extends TestCase
{
    use RefreshDatabase;

    private string $fakeAccessToken = 'foo';
    private string $fakeRefreshToken = 'bar';

    /** @test */
    public function access_token_method_returns_client_access_token_when_it_has_been_set(): void
    {
        $client = Client::factory()->create();
        $connector = $this->getConnector($client);

        $this->fakeInfinyAuthResponse();
        $this->assertEquals($connector->accessToken(), $client->access_token);
        $this->assertNotEquals($connector->accessToken(), $this->fakeAccessToken);
    }

    /** @test */
    public function access_token_method_requests_access_token_when_client_has_no_access_token(): void
    {
        $client = Client::factory()->create(['access_token' => null]);
        $connector = $this->getConnector($client);

        $this->fakeInfinyAuthResponse();
        $this->assertEquals($connector->accessToken(), $this->fakeAccessToken);
    }

    /** @test */
    public function access_token_method_requests_access_token_when_receives_parameter_to_refresh(): void
    {
        $client = Client::factory()->create();
        $connector = $this->getConnector($client);

        $this->fakeInfinyAuthResponse();
        $this->assertEquals($connector->accessToken(true), $this->fakeAccessToken);
    }

    /** @test */
    public function access_token_method_stores_access_and_refresh_tokens(): void
    {
        $client = Client::factory()->create();
        $connector = $this->getConnector($client);

        $this->fakeInfinyAuthResponse();
        $connector->accessToken(true);

        $this->assertEquals($client->access_token, $this->fakeAccessToken);
        $this->assertEquals($client->refresh_token, $this->fakeRefreshToken);
    }

    /** @test */
    public function access_token_method_updates_refresh_token_when_requests_access_token(): void
    {
        $client = Client::factory()->create(['access_token' => null]);
        $connector = $this->getConnector($client);

        $this->fakeInfinyAuthResponse();
        $connector->accessToken();

        $this->assertEquals($client->refresh_token, $this->fakeRefreshToken);
    }

    /** @test */
    public function access_token_method_throws_certain_error_when_cant_authenticate(): void
    {
        $client = Client::factory()->create(['access_token' => null]);
        $connector = $this->getConnector($client);

        Http::fake(['https://demo.infiny.cloud/api/oauth2/*' => Http::response([], 401)]);
        $this->expectException(InfinyRequestException::class);
        $connector->accessToken();
    }

    /** @test */
    public function get_http_client_method_returns_http_client()
    {
        $client = Client::factory()->create();
        $httpClient = resolve(HttpClientInterface::class);
        $connector = new InfinyHttpConnector($client, $httpClient);

        $output = $connector->getHttpClient();
        $this->assertSame($httpClient, $output);
    }

    private function getConnector(Client $client): HttpClientConnector
    {
        return new InfinyHttpConnector($client, resolve(HttpClientInterface::class));
    }

    private function fakeInfinyAuthResponse(): void
    {
        $response = Http::response([
            'access_token' => $this->fakeAccessToken,
            'refresh_token' => $this->fakeRefreshToken,
        ]);
        Http::fake(['https://demo.infiny.cloud/api/oauth2/*' => $response]);
    }
}
