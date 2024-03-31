@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Service Details') }}</div>
        <div class="card-body">
            <table class="table">
                @include('partials.session-error', ['key' => 'infiny_service_details_response_error'])
                <tbody>
                    @include('partials.render-nested-data', ['items' => $service, 'level' => 0])
                </tbody>
            </table>
        </div>
    </div>
@endsection

