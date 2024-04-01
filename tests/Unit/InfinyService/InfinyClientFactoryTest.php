<?php

namespace Tests\Unit\InfinyService;

use App\Models\Client;
use App\Services\Infiny\Interfaces\InfinyClientFactoryInterface;
use App\Services\Infiny\Interfaces\InfinyClientInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InfinyClientFactoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_method_creates_infiny_client(): void
    {
        $client = Client::factory()->create();
        $infinyClient = resolve(InfinyClientFactoryInterface::class)->create($client);

        $this->assertInstanceOf(InfinyClientInterface::class, $infinyClient);
    }
}
