<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'User Management System') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- JS -->
        <script src="{{ asset('js/app.js') }}" defer></script>

    </head>
    <body class="antialiased">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="#">{{ config('app.name', 'User Management System ') }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="form-inline my-2 my-lg-0">
                    @if (Route::has('login'))
                        <div>
                            @auth
                                <span class="text-wrap"> Hi {{ Auth::user()->name }}</span>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                <form style="display:none" method="POST" action="{{ route('logout') }}" id="logout-form">
                                    @csrf
                                </form>
                            @else
                                <a href="{{ route('login') }}">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        @if (Route::has('login'))
                            @can('is-admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.users.index') }}">User</a>
                                </li>
                                <li class="nav-item">
{{--                                    <a class="nav-link" href="{{ route('user.urls.all') }}">All Urls</a>--}}
                                </li>
                            @endcan
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.urls.index') }}">My Urls</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <main class="container">
            @include('partials.alerts')
            @yield('content')
        </main>
    </body>
</html>
