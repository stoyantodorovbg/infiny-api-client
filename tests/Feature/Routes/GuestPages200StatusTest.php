<?php

namespace Tests\Feature\Routes;

use Tests\TestCase;

class GuestPages200StatusTest extends TestCase
{
    /** @test */
    public function up_returns_a_successful_response(): void
    {
        $response = $this->get('/up');
        $response->assertStatus(200);
    }

    /** @test */
    public function home_welcome_returns_a_successful_response(): void
    {
        $response = $this->get(route('home.welcome'));
        $response->assertStatus(200);
    }

    /** @test */
    public function get_login_returns_a_successful_response(): void
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
    }

    /** @test */
    public function password_request_returns_a_successful_response(): void
    {
        $response = $this->get(route('password.request'));
        $response->assertStatus(200);
    }

    /** @test */
    public function register_returns_a_successful_response(): void
    {
        $response = $this->get(route('register'));
        $response->assertStatus(200);
    }
}
