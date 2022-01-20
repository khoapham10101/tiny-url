@extends('templates.main')
@section('content')
    <h1>Your Urls List</h1>

    <a class="btn btn-success btn-sm" href="{{ route('user.urls.create') }}">Create</a>
    <div class="card">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">@sortablelink('id', 'ID')</th>
                <th scope="col">Full Url</th>
                <th scope="col">Short Url</th>
                <th scope="col">Hits</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if ($urls->count() == 0)
                <tr>
                    <td colspan="5">No urls to display.</td>
                </tr>
            @endif
            @foreach($urls as $url)
                <tr>
                    <th scope="row"><a class="link-info" href="{{ route('user.urls.show', $url->id) }}">{{ $url->id }}</a></th>
                    <td>{{ $url->long_url }}</td>
                    <td>
                    <a class="" href="{{ url('/') . '/' . $url->short_url }}">{{ $url->short_url }}</a>
                    </td>
                    <td>{{ $url->hits }}</td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('user.urls.show', $url->id) }}">View</a>
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

        <p>
            Displaying {{$urls->count()}} of {{ $urls->total() }} url(s).
        </p>
        {!! $urls->appends(Request::except('page'))->render() !!}
    </div>
@endsection
