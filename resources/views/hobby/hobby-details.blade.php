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
        <form style="display: inline;" action="/hobby/{{ $hobby->id }}"
              method="post">
            @csrf
            @method('DELETE')
            <input class="btn btn-outline-danger btn-sm ml-2" type="submit"
                   value="Löschen">
        </form>
    </div>
</div>

<div>
    @foreach($hobby->tags as $tag)
        <a class="badge badge-{{$tag->style}}"
           href="/hobby/tag/{{ $tag->id }}">{{ $tag->name }}</a>
    @endforeach
</div>
