@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        <h2>Hallo {{auth()->user()->name}}</h2>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(isset($hobbies) && $hobbies->count() > 0)
                            <div id="h5">Deine Hobbies</div>
                            <ul class="list-group">
                                @foreach($hobbies as $hobby)
                                    <li class="list-group-item custom-list-item">
                                        <span>{{$hobby->name}}</span>
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
                                                <a class="badge badge-{{$tag->style}}"
                                                   href="/hobby/tag/{{$tag->id}}">{{$tag->name}}</a>
                                            @endforeach
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <a href="/hobby/create" class="btn btn-success btn-sm">
                            <i class="fas fa-plus-circle"></i>&nbsp;Neues Hobby</a>
                    </div>
                </div>
                {{ session('status') }}
            </div>
        </div>
    </div>
@endsection
