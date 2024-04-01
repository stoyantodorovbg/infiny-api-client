<?php

namespace Tests\Unit\InfinyService;

use App\Models\Client;
use App\Services\Infiny\Exceptions\InfinyRequestException;
use App\Services\Infiny\Interfaces\InfinyClientFactoryInterface;
use App\Services\Infiny\Interfaces\InfinyClientInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Tests\TestCase;

class InfinyHttpClientTest extends TestCase
{
    use RefreshDatabase;

    private string $fakeAccessToken = 'foo';
    private string $fakeRefreshToken = 'bar';
    private array $fakeServicesResponse = ['foo1' => 'bar2'];
    private array $fakeServiceDetailsResponse = ['foo12' => 'bar22'];

    /** @test */
    public function services_method_doesnt_request_token_when_it_has_been_obtained()
    {
        $accessToken = Str::random(50);
        $client = Client::factory()->create(['access_token' => $accessToken]);
        $infinyClient = $this->getClient($client);

        Http::fake([
            'https://demo.infiny.cloud/api/services' => Http::response([]),
            'https://demo.infiny.cloud/api/oauth2/*' => Http::response([], 401),
        ]);
        $infinyClient->services();
        $this->assertSame($accessToken, $client->access_token);
    }

    /** @test */
    public function services_method_requests_token_when_it_has_not_been_obtained()
    {
        $client = Client::factory()->create(['access_token' => null]);
        $infinyClient = $this->getClient($client);

        Http::fake([
            'https://demo.infiny.cloud/api/services' => Http::response([]),
            'https://demo.infiny.cloud/api/oauth2/*' => Http::response([
                'access_token' => $this->fakeAccessToken,
                'refresh_token' => $this->fakeRefreshToken,
            ]),
        ]);
        $infinyClient->services();
        $this->assertSame($this->fakeAccessToken, $client->access_token);
    }

    /** @test */
    public function services_method_receives_infiny_services_data()
    {
        $client = Client::factory()->create();
        $infinyClient = $this->getClient($client);

        Http::fake([
            'https://demo.infiny.cloud/api/services' => Http::response($this->fakeServicesResponse),
        ]);
        $response = $infinyClient->services();
        $this->assertEquals($response->json(), $this->fakeServicesResponse);
    }

    /** @test */
    public function service_details_method_doesnt_request_token_when_it_has_been_obtained()
    {
        $accessToken = Str::random(50);
        $client = Client::factory()->create(['access_token' => $accessToken]);
        $infinyClient = $this->getClient($client);

        Http::fake([
            'https://demo.infiny.cloud/api/services/*' => Http::response([]),
            'https://demo.infiny.cloud/api/oauth2/*' => Http::response([], 401),
        ]);
        $infinyClient->serviceDetails(1);
        $this->assertSame($accessToken, $client->access_token);
    }

    /** @test */
    public function service_details_method_requests_token_when_it_has_not_been_obtained()
    {
        $client = Client::factory()->create(['access_token' => null]);
        $infinyClient = $this->getClient($client);

        Http::fake([
            'https://demo.infiny.cloud/api/services/*' => Http::response([]),
            'https://demo.infiny.cloud/api/oauth2/*' => Http::response([
                'access_token' => $this->fakeAccessToken,
                'refresh_token' => $this->fakeRefreshToken,
            ]),
        ]);
        $infinyClient->servicedetails(1);
        $this->assertSame($this->fakeAccessToken, $client->access_token);
    }

    /** @test */
    public function service_details_method_receives_infiny_services_data()
    {
        $client = Client::factory()->create();
        $infinyClient = $this->getClient($client);

        Http::fake([
            'https://demo.infiny.cloud/api/services/*' => Http::response($this->fakeServiceDetailsResponse),
        ]);
        $response = $infinyClient->serviceDetails(1);
        $this->assertEquals($response->json(), $this->fakeServiceDetailsResponse);
    }

    private function getClient(Client $client): InfinyClientInterface
    {
        return resolve(InfinyClientFactoryInterface::class)->create($client);
    }
}
