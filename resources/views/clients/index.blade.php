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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>
                                <a href="{{ route('clients.edit', $client) }}">
                                    <i class="bi-pencil-square"></i>
                                </a>
                                <a href="{{ route('clients.delete', $client) }}">
                                    <i class="bi-trash-fill text-danger"></i>
                                </a>
                            </td>
                            <td>{{ $client->name }}</td>
                        </tr>
                  @endforeach
                </tbody>
            </table>
            {{ $clients->links() }}
        </div>
    </div>
@endsection
