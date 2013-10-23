<nav aria-label="{{ $label }}" role="navigation"><!-- role explicit for older browsers, using aria-label to differentiate from other navs -->
    <ul role="{{ $role }}" aria-activedescendant="{{ $active }}">
        @foreach ($items as $item)
        {{ $item }}
        @endforeach
    </ul><!-- //{{ $role }} -->
</nav><!-- //navigation -->
