@extends('layouts.app')

@section('title', 'MyHobbies')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Startseite</div>

                <div class="card-body">
                    Willkommen bei Massis MyHobbies!
                    <a class="btn btn-primary fa-pull-right" href="/hobby"><i class="fas fa-stop-circle"> Los!</i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
