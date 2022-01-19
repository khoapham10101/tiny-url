@extends('templates.main')
@section('content')
    <h1>Create a new Url</h1>

    <div class="card">
        <form method="POST" action="{{ route('user.urls.store') }}">
            @csrf
            <div class="mb-3">
                <label for="long_url" class="form-label">Please put your Url</label>
                <input name="long_url" type="url" class="form-control @error('long_url') is-invalid @enderror" id="name" aria-describedby="nameHelp" value="{{ old('long_url') }}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection
