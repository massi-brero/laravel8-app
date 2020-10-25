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
                                <li class="list-group-item custom-list-item">
                                    <span>{{$hobby->name}}</span>
                                    <div>von <a href="/user/{{$hobby->user->id}}">{{$hobby->user->name}}</a>
                                        ({{$hobby->user->hobbies->count()}} Hobbies) --&nbsp;
                                    </div>
                                    <div>  {{$hobby->created_at->diffForHumans()}}</div>
                                    <form action="/hobby/{{ $hobby->id }}" method="post" class="list-form">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit"
                                               class="ml-2 btn btn-sm btn-outline-danger"
                                               value="Löschen">
                                    </form>
                                    <a class="ml-2 btn btn-sm btn-outline-primary"
                                       href="hobby/{{$hobby->id}}">
                                        <i class="fas fa-eye mr-1"></i>Details</a>
                                    <a class="ml-2 btn btn-sm btn-outline-primary"
                                       href="hobby/{{$hobby->id}}/edit">
                                        <i class="fas fa-user-edit mr-1"></i>Bearbeiten</a>
                                    <div class="list-badges">
                                        @foreach($hobby->tags as $tag)
                                            <a class="badge badge-{{$tag->style}}" href="/hobby/tag/{{$tag->id}}">{{$tag->name}}</a>
                                        @endforeach
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        @auth()
                            <a href="/hobby/create" class="btn btn-success btn-sm mt-3"><i
                                    class="fas fa-search-plus"></i>
                                Neues Hobby</a>
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
