<?php

namespace App\Actions\Infiny;

use App\Models\Client;
use App\Services\Infiny\Exceptions\InfinyRequestException;
use App\Services\Infiny\Interfaces\InfinyClientFactoryInterface;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Session;
use Lorisleiva\Actions\Concerns\AsAction;

class RequestServices
{
    use AsAction;

    protected string $sessionErrorKey = 'infiny_services_response_error';

    public function __construct(protected InfinyClientFactoryInterface $infinyClientFactory)
    {
    }

    public function handle(Client $client): array
    {
        $infinyClient = $this->infinyClientFactory->create($client);

        try {
            $response = $infinyClient->services();
            if ($response->ok()) {
                return $response->json()['services'];
            }
            $message = $response->json()['message'] ?? '';
            Session::put($this->sessionErrorKey, "API Response {$response->status()}. {$message}");
        } catch (InfinyRequestException|AuthorizationException $e) {
            Session::put($this->sessionErrorKey, $e->getMessage());
        } catch (Exception $e) {
            Session::put($this->sessionErrorKey, 'Something went wrong.');
        }

        return [];
    }
}
