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
    <div class="col-md-6 col-6 m-1">
        <label for="client-type">{{ __('Environment') }}</label>
        <select
            name="environment"
            class="form-select"
            id="client-environment"
        >
            @foreach($environments as $environment)
                <option
                    value="{{ $environment->value }}"
                    {{ old('environment', $client->environment) === $environment ? 'selected' : '' }}
                >
                    {{ $environment->label() }}
                </option>
            @endforeach
        </select>
        @include('partials.form-validation', ['name' => 'environment'])
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
