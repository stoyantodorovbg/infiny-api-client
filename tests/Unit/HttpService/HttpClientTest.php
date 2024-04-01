<?php

namespace Tests\Unit\HttpService;

use App\Services\Http\Interfaces\HttpClientInterface;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use Illuminate\Http\Client\Response;

class HttpClientTest extends TestCase
{
    private array $fake200ResponseData = ['message' => 'Success'];
    private array $fake500ResponseData = ['message' => 'Internal Server Error'];
    private array $fake400ResponseData = ['message' => 'Wrong JSON format'];

    /** @test */
    public function get_request_returns_successful_response()
    {
        $httpClient = resolve(HttpClientInterface::class);

        Http::fake(['https://dummy-host/test' => Http::response($this->fake200ResponseData)]);
        $response = $httpClient->getRequest('https://dummy-host/test');
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->status());
        $this->assertSame($response->json(), $this->fake200ResponseData);
    }

    /** @test */
    public function get_request_returns_unsuccessful_response()
    {
        $httpClient = resolve(HttpClientInterface::class);

        Http::fake(['https://dummy-host/test' => Http::response($this->fake500ResponseData, 500)]);
        $response = $httpClient->getRequest('https://dummy-host/test');
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(500, $response->status());
        $this->assertSame($response->json(), $this->fake500ResponseData);

        Http::fake(['https://dummy-host/test1' => Http::response($this->fake400ResponseData, 400)]);
        $response = $httpClient->getRequest('https://dummy-host/test1');
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(400, $response->status());
        $this->assertSame($response->json(), $this->fake400ResponseData);
    }

    /** @test */
    public function post_request_returns_successful_response()
    {
        $httpClient = resolve(HttpClientInterface::class);

        Http::fake(['https://dummy-host/test' => Http::response($this->fake200ResponseData)]);
        $response = $httpClient->postRequest('https://dummy-host/test');
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->status());
        $this->assertSame($response->json(), $this->fake200ResponseData);
    }

    /** @test */
    public function post_request_returns_unsuccessful_response()
    {
        $httpClient = resolve(HttpClientInterface::class);

        Http::fake(['https://dummy-host/test' => Http::response($this->fake500ResponseData, 500)]);
        $response = $httpClient->postRequest('https://dummy-host/test');
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(500, $response->status());
        $this->assertSame($response->json(), $this->fake500ResponseData);

        Http::fake(['https://dummy-host/test1' => Http::response($this->fake400ResponseData, 400)]);
        $response = $httpClient->postRequest('https://dummy-host/test1');
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(400, $response->status());
        $this->assertSame($response->json(), $this->fake400ResponseData);
    }
}
