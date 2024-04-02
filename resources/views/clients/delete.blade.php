@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Delete Client') }}</div>
        <div class="card-body">
            <p>{{ __('Are you sure?') }}</p>
            <form method="POST" action="{{ route('clients.destroy', $client) }}">
                @method('DELETE')
                @csrf
                <a class="link-button" href="{{ route('clients.index') }}">
                    <button type="button" class="btn btn-light">{{ __('Cancel') }}</button>
                </a>
                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
            </form>
        </div>
    </div>
@endsection
