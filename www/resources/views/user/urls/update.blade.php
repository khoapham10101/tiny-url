@extends('templates.main')
@section('content')
    <div class="card">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>Update an Url ({{ $url->id }})</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-dark btn-sm" href="{{ route('user.urls.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="card">
        <form method="POST" action="{{ route('user.urls.update', $url->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="long_url" class="form-label">Please put your Url</label>
                <input name="long_url" type="url" class="form-control @error('long_url') is-invalid @enderror" id="name" aria-describedby="nameHelp" value="{{ $url->long_url }}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="short_url" class="form-label">Shorten URL: {{ $url->short_url }}</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection
