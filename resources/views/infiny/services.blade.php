@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Services') }}</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('Actions') }}</th>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('Type Short Name') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Paused') }}</th>
                        <th>{{ __('Expired') }}</th>
                        <th>{{ __('Created At') }}</th>
                    </tr>
                </thead>
                @include('partials.session-error', ['key' => 'infiny_services_response_error'])
                <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>
                            <a href="{{ route('infiny.serviceDetails', ['client' => $clientId, 'serviceId' => $service['id']]) }}">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                        </td>
                        <td>{{ $service['id'] }}</td>
                        <td>{{ $service['name'] }}</td>
                        <td>{{ $service['type'] }}</td>
                        <td>{{ $service['type_short_name'] }}</td>
                        <td>{{ $service['status'] }}</td>
                        <td>@include('partials.is-active', ['isActive' => $service['paused']])</td>
                        <td>@include('partials.is-active', ['isActive' => $service['expired']])</td>
                        <td>{{ $service['created'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
