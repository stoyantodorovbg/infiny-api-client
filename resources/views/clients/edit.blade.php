@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('clients.update', $client) }}">
        @method('PUT')
        @csrf
        @include('clients.partials.form-fields')
        <a href="{{ route('clients.index') }}">
            <button type="button" class="btn btn-light">{{ __('Cancel') }}</button>
        </a>
        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
    </form>
@endsection
