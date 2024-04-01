<?php

namespace App\Actions\Infiny;

use App\Models\Client;
use App\Services\Infiny\Exceptions\InfinyRequestException;
use App\Services\Infiny\Interfaces\InfinyClientFactoryInterface;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
use Lorisleiva\Actions\Concerns\AsAction;

class RequestServiceDetails
{
    use AsAction;

    protected string $sessionErrorKey = 'infiny_service_details_response_error';

    public function __construct(protected InfinyClientFactoryInterface $infinyClientFactory)
    {
    }

    public function handle(Client $client, int $serviceId): array
    {
        $infinyClient = $this->infinyClientFactory->create($client);

        try {
            $response = $infinyClient->serviceDetails($serviceId);
            if ($response->ok()) {
                return $response->json();
            }
            $message = $response->json()['message'] ?? '';
            Session::put($this->sessionErrorKey, "API Response {$response->status()}. {$message}");
        } catch (InfinyRequestException $e) {
            Session::put($this->sessionErrorKey, $e->getMessage());
        } catch (Exception $e) {
            Session::put($this->sessionErrorKey, 'Something went wrong.');
        }

        return [];
    }
}
