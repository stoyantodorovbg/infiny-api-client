@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('All Clients') }}</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('Links') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Environment') }}</th>
                        <th>{{ __('Manage') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>
                                <a href="{{ route('infiny.services', $client) }}">{{ __('Services') }}</i></a>
                            </td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->environment->label() }}</td>
                            <td>
                                <a class="link-button" href="{{ route('clients.edit', $client) }}">
                                    <i class="bi-pencil-square text-success"></i>
                                </a>
                                <a class="link-button" href="{{ route('clients.delete', $client) }}">
                                    <i class="bi-trash-fill text-danger"></i>
                                </a>
                            </td>
                        </tr>
                  @endforeach
                </tbody>
            </table>
            {{ $clients->links() }}
        </div>
    </div>
@endsection
