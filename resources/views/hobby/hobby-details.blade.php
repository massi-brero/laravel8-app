<div class="hobby-details">@include('hobby.hobby-image-small')

    {{ $hobby->name }} <a class="ml-2"
                          href="/hobby/{{ $hobby->id }}">Detailansicht</a>

    <span class="mx-2">Von
        <a href="/user/{{$hobby->user->id}}">{{ $hobby->user->name }}</a>
        ( {{ $hobby->user->hobbies->count() }} Hobbies)
        @include('user.user-image-small')
    </span>

    <div class="btn-action-group">{{ $hobby->created_at->diffForHumans() }}
        @can('update', $hobby)
            <a class="ml-2 btn btn-sm btn-outline-primary"
               href="/hobby/{{ $hobby->id }}/edit"><i class="fas fa-edit"></i>
                Bearbeiten</a>
        @endcan
        @can('delete', $hobby)
            <button
                onclick="confirmDelete('das Hobby', '{{$hobby->name}}','hobby', {{$hobby->id}})"
                class="btn btn-sm btn-outline-danger ml-2">
                Löschen
            </button>
        @endcan
    </div>
</div>

<div>
    @foreach($hobby->tags as $tag)
        <a class="badge badge-{{$tag->style}}"
           href="/hobby/tag/{{ $tag->id }}">{{ $tag->name }}</a>
    @endforeach
</div>
