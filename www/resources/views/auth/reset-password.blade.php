@extends('templates.main')
@section('content')
    <h1>Password Reset</h1>


    <form method="POST" action="{{ url('reset-password') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->token }}">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $request->email }}">
            @error('email')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" value="{{ old('password') }}">
            @error('password')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Password</label>
            <input name="password_confirmation" type="password" class="form-control @error('password_configmation') is-invalid @enderror" id="password_confirmation" value="{{ old('password_confirmation') }}">
            @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
