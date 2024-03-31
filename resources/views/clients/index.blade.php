@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('All Clients') }}</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('Launch') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Manage') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>
                                <a href="{{ route('infiny.home', $client) }}"><i class="bi bi-caret-right-fill text-primary"></i></a>
                            </td>
                            <td>{{ $client->name }}</td>
                            <td>
                                <a href="{{ route('clients.edit', $client) }}">
                                    <i class="bi-pencil-square text-success"></i>
                                </a>
                                <a href="{{ route('clients.delete', $client) }}">
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
