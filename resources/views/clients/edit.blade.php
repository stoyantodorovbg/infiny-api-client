@extends('layouts.app')

@section('content')
    <div class="p-5">
        <form method="POST" action="{{ route('clients.update', $client) }}">
            @method('PUT')
            @csrf
            @include('clients.partials.form-fields')
            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </form>
    </div>
@endsection
