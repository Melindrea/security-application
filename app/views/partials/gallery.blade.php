<ul id="{{ $slug }}-gallery" class="js-gallery">
    @foreach ($items as $itemSlug)
    <li>
        {{ HTML::thumbnail($itemSlug) }}
    </li>
    @endforeach
</ul>
