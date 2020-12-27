<div class="card-body">
    <ul class="list-group">
        @foreach($hobbies as $hobby)
        <li class="list-group-item">
            @include('_partials.hobby.hobby-details')
        </li>
        @endforeach
    </ul>
    @auth
        <a class="btn btn-success btn-sm mt-3" href="/hobby/create"><i
                class="fas fa-plus-circle"></i> Neues Hobby anlegen</a>
    @endauth
    <div class="mt-3">
        {{ $hobbies->links("pagination::bootstrap-4") }}
    </div>
</div>
