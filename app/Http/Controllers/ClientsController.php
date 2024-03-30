<?php

namespace App\Http\Controllers;

use App\Actions\Clients\ClientFromRequest;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class ClientsController
{
    /**
     * User clients index
     *
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('clients.index');
    }

    /**
     * Create client page
     *
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('clients.create', ['client' => new Client()]);
    }

    /**
     * Store a client
     *
     * @param ClientRequest $request
     * @return Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
     */
    public function store(ClientRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        ClientFromRequest::run($request);

        return redirect(route('clients.index'));
    }

    /**
     * Edit client page
     *
     * @param Client $client
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function edit(Client $client): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update a client
     *
     * @param Client        $client
     * @param ClientRequest $request
     * @return Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
     */
    public function update(Client $client, ClientRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        ClientFromRequest::run($request, $client);

        return redirect(route('clients.index'));
    }

    /**
     * delete a client
     *
     * @param Client $client
     * @return \Illuminate\Contracts\Foundation\Application|Application|RedirectResponse|Redirector
     */
    public function delete(Client $client): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        return redirect(route('clients.index'));
    }
}
