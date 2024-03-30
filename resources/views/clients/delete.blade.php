@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            {{ __('Are you sure?') }}
        </div>
    </div>
    <form method="POST" action="{{ route('clients.destroy', $client) }}">
        @method('DELETE')
        @csrf
        <a href="{{ route('clients.index') }}">
            <button type="button" class="btn btn-light mt-5">{{ __('Cancel') }}</button>
        </a>
        <button type="submit" class="btn btn-danger mt-5">{{ __('Delete') }}</button>
    </form>
@endsection
