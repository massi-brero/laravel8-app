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
                        <a href="{{URL::previous()}}" class="btn btn-success btn-sm mt-3"><i class="fas fa-arrow-circle-up"></i> Zurück</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
