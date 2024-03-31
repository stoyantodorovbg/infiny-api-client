<?php

namespace App\Models;

use App\Models\Enum\ClientEnvironment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    protected function casts(): array
    {
        return [
            'environment' => ClientEnvironment::class,
            'client_secret' => 'encrypted',
            'access_token' => 'encrypted',
            'refresh_token' => 'encrypted',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
