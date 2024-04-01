<?php

namespace App\Rules;

use App\Models\Client;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Builder;

class ClientNameUnique implements ValidationRule
{
    public function __construct(
        protected User $user,
        protected Client|null $client,
        protected string $method,
    )
    {
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $count = Client::query()->where(fn (Builder $query) => $query
            ->where('name', $value)
            ->where('user_id', $this->user->id)
            ->when(
                value: $this->method === 'PUT',
                callback: fn (Builder $query) => $query->where('id', '!=', $this->client->id),
            ),
        )->count();

        if ($count) {
            $fail('The :attribute must be unique.');
        }
    }
}
