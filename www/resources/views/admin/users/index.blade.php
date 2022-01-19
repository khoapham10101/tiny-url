@extends('templates.main')
@section('content')
    <h1>User</h1>

    <a class="btn btn-success btn-sm" href="{{ route('admin.users.create') }}">Create</a>
    <div class="card">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.users.edit', $user->id) }}">Edit</a>
                        <button class="btn btn-danger btn-sm" href="{{ route('admin.users.destroy', $user->id) }}"
                            onclick="event.preventDefault(); document.getElementById('delete-user-form-{{ $user->id }}').submit();"
                        >Delete</button>

                        <form id="delete-user-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:none">
                            @csrf
                            @method("DELETE")
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
@endsection
