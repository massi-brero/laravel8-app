<a class="mr-1" title="Details anzeigen" href="/hobby/{{ $hobby->id }}">
    @if(file_exists('img/hobby/' . $hobby->id  . '_landscape_thumb.jpg'))
    <img class="rounded"src="/img/hobby/{{ $hobby->id  }}_landscape_thumb.jpg" alt="thumb">
    @else()
    <img class="rounded" src="/img/thumb_quer.jpg" alt="thumb">
    @endif
</a>
