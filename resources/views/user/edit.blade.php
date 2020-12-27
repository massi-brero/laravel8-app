@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">User bearbeiten</div>
                    <div class="card-body">
                        <form action="/user/{{ $user->id }}" method="post" enctype="multipart/form-data"
                              autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Motto</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('motto') ? 'border-danger' : '' }}"
                                       id="motto"
                                       name="motto"
                                       value="{{ $user->motto ?? old('motto') }}">
                                <small class="text text-danger">{!! $errors->first('motto') !!}</small>
                            </div>
                            <div class="w-25">
                                @include('_partials.user.user-image-big')
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
                                <label for="beschreibung">Über mich</label>
                                <textarea class="form-control"
                                          id="ueber_mich"
                                          name="ueber_mich">{{ $user->ueber_mich ?? old('ueber_mich') }}</textarea>
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
