@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Create Client') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('clients.store') }}">
                @csrf
                @include('clients.partials.form-fields')
                <a class="link-button" href="{{ route('clients.index') }}">
                    <button type="button" class="btn btn-light">{{ __('Cancel') }}</button>
                </a>
                <button type="submit" class="btn btn-primary m-1">{{ __('Create') }}</button>
            </form>
        </div>
    </div>
@endsection
