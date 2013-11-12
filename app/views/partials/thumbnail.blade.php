<figure id="{{ $slug }}-figure" class="js-thumbnail">
    <a href="{{ asset($large) }}">
        {{ HTML::image($thumbnail, $alt, $attributes) }}
    </a>
    @if ($caption)
    <figcaption>{{ $caption }}</figcaption>
    @endif
</figure>
