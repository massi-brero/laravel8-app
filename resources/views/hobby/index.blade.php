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
                                    {{$hobby->name}}
                                </li>
                            @endforeach
                        </ul>
                        <a href="hobby/create" class="btn btn-success btn-sm mt-3"><i class="fas fa-search-plus"></i> Neues Hobby</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
