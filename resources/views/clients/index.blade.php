@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('Links') }}</th>
                <th>{{ __('Type') }}</th>
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
                    <td>{{ $client->type->label() }}</td>
                    <td>{{ $client->name }}</td>
                </tr>
          @endforeach
        </tbody>
    </table>
    {{ $clients->links() }}
@endsection
