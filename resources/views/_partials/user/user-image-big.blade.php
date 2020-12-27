@if(file_exists('img/user/' . $user->id  . '_portrait_big.jpg'))
    @auth
        <img class="rounded" src="/img/user/{{ $user->id  }}_portrait_big.jpg"
             alt="user thumb">
    @endauth
    @guest
        <img class="rounded" src="/img/user/{{ $user->id  }}_portrait_big_pixelated.jpg"
             alt="user thumb">
    @endguest
@else()
    <img class="rounded w-100" src="/img/300x400.jpg" alt="thumb">
@endif
