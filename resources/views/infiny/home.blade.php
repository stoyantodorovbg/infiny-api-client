@extends('layouts.app')

@section('content')
    @include('navs.infiny-endpoints')
    <div class="card mt-3">
        <div class="card-body">
            {{ $ping ? __('API connected. Please select an endpoint.') : __('Connecting to Infiny failed. Please check client credentials.') }}
        </div>
    </div>
@endsection
