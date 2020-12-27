@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Alle Hobbies</div>
                    @include('_partials.hobby.hobby-list')</div>
                </div>
            </div>
        </div>
    </div>
@endsection
