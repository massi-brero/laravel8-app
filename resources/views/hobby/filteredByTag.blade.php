@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Alle Hobbies gefiltered nach
                        <span style="font-size: 120%"
                              class="ml-2 badge badge-{{$tag->style}}">{{$tag->name}}
                        </span>
                        <a class="float-right" href="/hobby">Alle Hobbies anzeigen</a>
                    </div>
                    @include('hobby.hobby-list')
                </div>
            </div>
        </div>
    </div>
@endsection
