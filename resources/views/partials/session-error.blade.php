@if(Session::has($key))
    <p class="text-danger">{{ Session::pull($key) }}</p>
@endif
