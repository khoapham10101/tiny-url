@extends('templates.main')
@section('content')

    <a class="btn btn-success btn-sm" href="{{ route('user.urls.create') }}">Create</a>
    <div class="card">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>Url detail</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-dark btn-sm" href="{{ route('user.urls.index') }}"> Back</a>
                <a class="btn btn-primary btn-sm" href="{{ route('user.urls.edit', $url->id) }}">Edit</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Long Url:</strong>
                {{ $url->long_url }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Shorten Url:</strong>
                {{ $url->short_url }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Hits:</strong>
                {{ $url->hits }}
            </div>
        </div>
    </div>
@endsection
