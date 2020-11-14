@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Hobby bearbeiten</div>
                    <div class="card-body">
                        <form action="/hobby/{{ $hobby->id }}" method="post" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}"
                                       id="name"
                                       name="name"
                                       value="{{ old('name') ?? $hobby->name }}">
                                <small class="text text-danger">{!! $errors->first('name') !!}</small>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="bild">Bild</label>
                                    <input type="file"
                                           class="form-control {{ $errors->has('bild') ? 'border-danger' : '' }}"
                                           id="bild"
                                           name="bild"
                                           value="">
                                    <small class="text text-danger">{!! $errors->first('bild') !!}</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="beschreibung">Beschreibung</label>
                                <textarea class="form-control {{ $errors->has('beschreibung') ? 'border-danger' : '' }}"
                                          id="beschreibung"
                                          name="beschreibung">{{ old('beschreibung') ?? $hobby->beschreibung }}</textarea>
                                <small class="text text-danger">{!! $errors->first('beschreibung') !!}</small>
                            </div>
                            <input type="submit" class="btn btn-primary btn-sm mt-3 float-left" value="Absenden"/>
                        </form>
                        <a href="/" class="btn btn-primary btn-sm mt-3 float-right"><i
                                class="fas fa-arrow-alt-circle-up"></i>
                            Start</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
