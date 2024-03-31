<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContentInfiny" aria-controls="navbarSupportedContentInfiny" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContentInfiny">
            <ul class="navbar-nav ms-auto">
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('infiny.services', $client) }}">{{ __('Services') }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
