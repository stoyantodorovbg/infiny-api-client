<?php

namespace App\Actions\Clients;

use App\Data\Client\ClientData;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class ClientFromRequest
{
    use AsAction;

    public function __construct(protected ClientRepositoryInterface $clientRepository)
    {

    }

    public function handle(ClientRequest $request, Client|null $client = null): Client
    {
        $data = new ClientData(
            user: $request->user(),
            name: $request->get('name'),
            clientId: $request->get('client_id'),
            clientSecret: $request->get('client_secret'),
        );

        /** @var Client */
        return match($request->method()) {
            'POST' => $this->clientRepository->store($data),
            'PUT' => $this->clientRepository->update($client, $data),
        };
    }
}
