<a href="/user/{{ $user->id }}">
    @if(file_exists('img/user/' . $user->id  . '_portrait_big.jpg'))
        <img class="rounded" src="/img/user/{{ $user->id  }}_portrait_big.jpg"
             alt="user thumb">
    @else()
        <img class="rounded" src="/img/300x400.jpg" alt="thumb">
    @endif
</a>
