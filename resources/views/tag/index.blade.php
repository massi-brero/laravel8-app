@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Alle Tags</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($tags as $tag)
                                <li class="list-group-item custom-list-item">
                                    <span class="badge-{{$tag->style}}  badge-pill p-2">{{$tag->name}}</span>
                                    <form action="/tag/{{ $tag->id }}" method="post" class="list-form">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit"
                                               class="ml-2 btn btn-sm btn-outline-danger"
                                               value="Löschen">
                                    </form>
                                    <a class="ml-2 btn btn-sm btn-outline-primary"
                                       href="tag/{{$tag->id}}/edit">
                                        <i class="fas fa-user-edit mr-1"></i>
                                        Bearbeiten
                                    </a>
                                    <a href="/hobby/tag/{{$tag->id}}">&nbsp;{{$tag->hobbies->count()}} mal verwendet</a>
                                </li>
                            @endforeach
                        </ul>
                        <a href="/tag/create" class="btn btn-success btn-sm mt-3"><i class="fas fa-search-plus"></i>
                            Neues Tag</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
