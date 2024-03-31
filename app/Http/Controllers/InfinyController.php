<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Foundation\Application as ContractApplication;

class InfinyController
{
    /**
     * Infiny home page
     * Pings API to check credentials
     *
     * @param Client $client
     * @return View|Application|Factory|ContractApplication
     */
    public function home(Client $client): View|Application|Factory|ContractApplication
    {
        // ping API to check connection
        $ping = true;

        return view('infiny.home', compact('ping', 'client'));
    }

    /**
     * Lists data from Infiny Services endpoint
     *
     *
     */
    public function services(Client $client): View|Application|Factory|ContractApplication
    {
        // Fetch API data
        $data = [];

        return view('infiny.services', compact('data'));
    }

    /**
     * View data from Infiny Service Details endpoint
     *
     *
     */
    public function serviceDetails(Client $client): View|Application|Factory|ContractApplication
    {
        // Fetch API data
        $data = [];

        return view('infiny.service-details', compact('data'));
    }
}
