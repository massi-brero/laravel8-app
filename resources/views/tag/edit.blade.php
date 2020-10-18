@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tag bearbeiten</div>
                    <div class="card-body">
                        <form action="/tag/{{ $tag->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text"
                                   class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}" id="name"
                                   name="name"
                                   value="{{ old('name') ?? $tag->name }}">
                            <small class="text text-danger">{!! $errors->first('name') !!}</small>
                        </div>
                        <div class="form-group">
                            <label for="style">Style</label>
                            <input class="form-control {{ $errors->has('style') ? 'border-danger' : '' }}"
                                      id="style"
                                      name="style" value="{{ old('style') ?? $tag->style }}">
                            <small class="text text-danger">{!! $errors->first('style') !!}</small>
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
