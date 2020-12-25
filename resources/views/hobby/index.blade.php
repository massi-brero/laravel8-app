@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Alle Hobbies</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($hobbies as $hobby)
                                <li class="list-group-item">

                                    <div class="hobby-details">
                                        @include('hobby.hobby-image-small')

                                        {{ $hobby->name }}

                                        <a class="ml-2" href="/hobby/{{ $hobby->id }}">Detailansicht</a>

                                        <span class="mx-2">von <a
                                                href="/user/{{$hobby->user->id}}">{{ $hobby->user->name }}</a>
                                        ( {{ $hobby->user->hobbies->count() }} Hobbies)
                                        <a href="/user/{{ $hobby->user->id }}">
                                            @include('user.user-image-small')
                                        </a>
                                        </span>

                                        <div class="btn-action-group">
                                            {{ $hobby->created_at->diffForHumans() }}
                                            @auth
                                                <a class="ml-2 btn btn-sm btn-outline-primary"
                                                   href="/hobby/{{ $hobby->id }}/edit"><i
                                                        class="fas fa-edit"></i>
                                                    Bearbeiten
                                                </a>
                                                <form style="display: inline;" action="/hobby/{{ $hobby->id }}"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input class="btn btn-outline-danger btn-sm ml-2" type="submit"
                                                           value="Löschen">
                                                </form>
                                            @endauth
                                        </div>
                                    </div>

                                    <div>
                                        @foreach($hobby->tags as $tag)
                                            <a class="badge badge-{{$tag->style}}"
                                               href="/hobby/tag/{{ $tag->id }}">{{ $tag->name }}</a>
                                        @endforeach
                                    </div>
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
                </div>
            </div>
        </div>
    </div>
@endsection
