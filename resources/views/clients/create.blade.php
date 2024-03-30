@extends('layouts.app')

@section('content')
    <div class="p-5">
    <form method="POST" action="{{ route('clients.store') }}">
        @csrf
        @include('clients.partials.form-fields')
        <button type="submit" class="btn btn-primary m-1">{{ __('Submit') }}</button>
    </form>
    </div>
@endsection
