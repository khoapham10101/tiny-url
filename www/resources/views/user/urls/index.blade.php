@extends('templates.main')
@section('content')
    <h1>Your Urls List</h1>

    <a class="btn btn-success btn-sm" href="{{ route('user.urls.create') }}">Create</a>
    <div class="card">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#Id</th>
                <th scope="col">Full Url</th>
                <th scope="col">Short Url</th>
                <th scope="col">Hits</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($urls as $url)
                <tr>
                    <th scope="row">{{ $url->id }}</th>
                    <td>{{ $url->long_url }}</td>
                    <td>{{ $url->short_url }}</td>
                    <td>{{ $url->hits }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('user.urls.edit', $url->id) }}">Edit</a>
                        <button class="btn btn-danger btn-sm" href="{{ route('user.urls.destroy', $url->id) }}"
                            onclick="event.preventDefault(); document.getElementById('delete-url-form-{{ $url->id }}').submit();"
                        >Delete</button>

                        <form id="delete-url-form-{{ $url->id }}" action="{{ route('user.urls.destroy', $url->id) }}" method="POST" style="display:none">
                            @csrf
                            @method("DELETE")
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $urls->links() }}
    </div>
@endsection
