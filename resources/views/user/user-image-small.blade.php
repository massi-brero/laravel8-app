<a href="/user/{{ $hobby->user->id }}">
    @if(file_exists('img/user/' . $hobby->user->id  . '_portrait_thumb.jpg'))
        <img class="rounded" src="/img/user/{{ $hobby->user->id  }}_portrait_thumb.jpg"
             alt="user thumb">
    @else()
        <img class="rounded" src="/img/thumb_hoch.jpg" alt="thumb">
    @endif
</a>
