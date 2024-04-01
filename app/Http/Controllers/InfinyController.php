<?php

namespace App\Http\Controllers;

use App\Actions\Infiny\RequestServiceDetails;
use App\Actions\Infiny\RequestServices;
use App\Models\Client;
use Illuminate\Contracts\Foundation\Application as ContractApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Gate;

class InfinyController
{
    /**
     * Lists data from Infiny Services endpoint
     *
     * @param Client $client
     * @return View|Application|Factory|ContractApplication
     */
    public function services(Client $client): View|Application|Factory|ContractApplication
    {
        Gate::authorize('view', $client);

        return view('infiny.services', [
            'services' => RequestServices::run($client),
            'clientId' => $client->id,
        ]);
    }

    /**
     * View data from Infiny Service Details endpoint
     *
     * @param Client $client
     * @param int    $serviceId
     * @return View|Application|Factory|ContractApplication
     */
    public function serviceDetails(Client $client, int $serviceId): View|Application|Factory|ContractApplication
    {
        Gate::authorize('view', $client);

        return view('infiny.service-details', [
            'service' => RequestServiceDetails::run($client, $serviceId),
            'clientId' => $client->id,
        ]);
    }
}
