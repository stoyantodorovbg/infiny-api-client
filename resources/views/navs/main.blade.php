<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand float-left" href="{{ route('home.dashboard') }}">
            {{ config('app.name', 'Infiny API Client') }}
        </a>
        @guest
            @include('navs.guest-main')
        @else
            @include('navs.user-main')
        @endguest
    </div>
</nav>
