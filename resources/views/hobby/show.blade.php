@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Die Details zum Hobby <a class="float-right" href="/user/{{$hobby->user->id}}">{{$hobby->user->name}}</a></div>
                    <div class="card-body">
                        <p>{{ $hobby->name }}</p>
                        <p>{{ $hobby->beschreibung }}</p>
                        <div class="list-badges">
                            @foreach($hobby->tags as $tag)
                                <a class="badge badge-{{$tag->style}}" href="">{{$tag->name}}</a>
                            @endforeach
                        </div>
                        <a href="{{URL::previous()}}" class="btn btn-success btn-sm mt-3"><i class="fas fa-arrow-circle-up"></i> Zurück</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
