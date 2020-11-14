@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Die Details zum Nutzer</div>
                    <div class="card-body">
                        <h3>{{$user->name}}</h3>
                        <p><b>Motto: </b> {{$user->motto}}</p>
                        <p><b>Über mich: </b> {{$user->ueber_mich}}</p>
                        <h5>Hobbies von {{$user->name}}</h5>
                        <ul class="list-group">
                            @if($user->hobbies->count() > 0)
                                @foreach($user->hobbies as $hobby)
                                    <li class="list-group-item custom-list-item">
                                        <span>{{$hobby->name}}</span>
                                        <div>  {{$hobby->created_at->diffForHumans()}}</div>
                                        <a class="ml-2 btn btn-sm btn-outline-primary"
                                           href="hobby/{{$hobby->id}}">
                                            <i class="fas fa-eye mr-1"></i>Details</a>
                                        <div class="list-badges">
                                            @foreach($hobby->tags as $tag)
                                                <a class="badge badge-{{$tag->style}}"
                                                   href="/hobby/tag/{{$tag->id}}">{{$tag->name}}</a>
                                            @endforeach
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                 <p>Dieser User hat noch keine Hobbies angelegt.</p>
                            @endif
                        </ul>
                        <a href="{{URL::previous()}}" class="btn btn-success btn-sm mt-3"><i
                                class="fas fa-arrow-circle-up"></i> Zurück</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
