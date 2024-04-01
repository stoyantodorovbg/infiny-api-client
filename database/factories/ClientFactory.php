<?php

namespace Database\Factories;

use App\Models\Enum\ClientEnvironment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create()->id,
            'name' => fake()->text(10),
            'environment' => ClientEnvironment::DEMO,
            'client_id' => Str::random(50),
            'client_secret' => Str::random(50),
            'access_token' => Str::random(50),
            'refresh_token' => Str::random(50),
        ];
    }
}
