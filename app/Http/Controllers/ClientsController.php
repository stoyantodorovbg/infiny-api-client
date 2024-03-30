<?php

namespace App\Http\Controllers;

use App\Actions\Clients\ClientFromRequest;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\User;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Foundation\Application as ContractApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class ClientsController
{
    /**
     * User clients index
     *
     * @param UserRepositoryInterface $userRepository
     * @return View|Application|Factory|ContractApplication
     */
    public function index(UserRepositoryInterface $userRepository): View|Application|Factory|ContractApplication
    {
        /** @var $user User */
        $user = auth()->user();

        return view('clients.index', ['clients' => $userRepository->userClientsPaginated($user)]);
    }

    /**
     * Create client page
     *
     * @return View|Application|Factory|ContractApplication
     */
    public function create(): View|Application|Factory|ContractApplication
    {
        return view('clients.create', ['client' => new Client()]);
    }

    /**
     * Store a client
     *
     * @param ClientRequest $request
     * @return Application|Redirector|RedirectResponse|ContractApplication
     */
    public function store(ClientRequest $request): Application|Redirector|RedirectResponse|ContractApplication
    {
        ClientFromRequest::run($request);

        return redirect(route('clients.index'));
    }

    /**
     * Edit client page
     *
     * @param Client $client
     * @return View|Application|Factory|ContractApplication
     */
    public function edit(Client $client): View|Application|Factory|ContractApplication
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update a client
     *
     * @param Client        $client
     * @param ClientRequest $request
     * @return Application|Redirector|RedirectResponse|ContractApplication
     */
    public function update(Client $client, ClientRequest $request): Application|Redirector|RedirectResponse|ContractApplication
    {
        ClientFromRequest::run($request, $client);

        return redirect(route('clients.index'));
    }

    /**
     * Delete confirmation page
     *
     * @param Client $client
     * @return View|Application|Factory|ContractApplication
     */
    public function delete(Client $client): View|Application|Factory|ContractApplication
    {
        return view('clients.delete', compact('client'));
    }

    /**
     * delete a client
     *
     * @param Client                    $client
     * @param ClientRepositoryInterface $clientRepository
     * @return ContractApplication|Application|RedirectResponse|Redirector
     */
    public function destroy(Client $client, ClientRepositoryInterface $clientRepository): Application|Redirector|RedirectResponse|ContractApplication
    {
        $clientRepository->destroy($client);

        return redirect(route('clients.index'));
    }
}
