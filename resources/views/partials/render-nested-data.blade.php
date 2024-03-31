@foreach($items as $key => $value)
    <tr>
        @for ($i = 0; $i < $level; $i++)
            <td class="border bg-white"></td>
        @endfor
        <td class="border bg-white">{{ str_replace('_', ' ', $key) }}</td>
        @if(is_array($value))
            <td class="border bg-white"></td><td class="border bg-white"></td>
            @include('partials.render-nested-data', ['items' => $value, 'level' => $level + 1])
        @elseif(is_bool($value))
            <td class="border">@include('partials.is-active', ['isActive' => $value])</td>
        @else
            <td class="border fw-lighter">{{ $value }}</td>
        @endif
    </tr>
@endforeach
