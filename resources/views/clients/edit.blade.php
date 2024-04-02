@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Edit Client') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('clients.update', $client) }}">
                @method('PUT')
                @csrf
                @include('clients.partials.form-fields')
                <a class="link-button" href="{{ route('clients.index') }}">
                    <button type="button" class="btn btn-light">{{ __('Cancel') }}</button>
                </a>
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            </form>
        </div>
    </div>
@endsection
