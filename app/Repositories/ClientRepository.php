<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;

class ClientRepository extends Repository implements ClientRepositoryInterface
{
    protected string $model = Client::class;
}
