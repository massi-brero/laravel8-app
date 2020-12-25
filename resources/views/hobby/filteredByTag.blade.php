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

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($hobbies as $hobby)
                                <li class="list-group-item">
                                    @include('hobby.hobby-details')
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-3">
                            {{ $hobbies->links("pagination::bootstrap-4") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
