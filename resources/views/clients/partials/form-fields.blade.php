<div class="d-flex col-12">
    <div class="col-md-6 col-6 m-1">
        <label for="client-name">{{ __('Name') }}</label>
        <input
            name="name"
            type="text"
            class="form-control"
            id="client-name"
            value="{{ old('name', $client?->name) }}"
        >
        @include('partials.form-validation', ['name' => 'name'])
    </div>
</div>

<div class="d-flex col-12">
    <div class="col-md-6 col-6 m-1">
        <label for="client-name">{{ __('Client ID') }}</label>
        <input
            name="client_id"
            type="text"
            class="form-control"
            id="client-name"
            value="{{ old('client_id', $client?->client_id) }}"
        >
        @include('partials.form-validation', ['name' => 'client_id'])
    </div>
    <div class="col-md-6 col-6 m-1">
        <label for="client-name">{{ __('Client Secret') }}</label>
        <input
            name="client_secret"
            type="text"
            class="form-control"
            id="client-name"
            value="{{ old('client_secret', $client?->client_secret) }}"
        >
        @include('partials.form-validation', ['name' => 'client_secret'])
    </div>
</div>
