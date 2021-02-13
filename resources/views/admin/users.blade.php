@extends('layouts.app')

@section('content')

<main class="container py-4">
    @include('admin.partials.tabs')
    <div class="table-responsive">
    <table class="table my-4 mx-auto" style="width: 750px">
        <thead>
            <tr>
                <th scope="col">Username</th>
                <th scope="col">email</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr @if($user->banned_at != null) class="table-danger" @endif>
                <td>
                    <a href="{{ '/profile/' . $user->username }}">
                        <img
                        src="{{ asset($user->imgProfile()) }}"
                        width="32"
                        height="32"
                        loading="lazy"
                        class="rounded-circle mr-1 profile-img"
                        style="object-fit: cover; object-position: center;"
                    />
                        {{ $user->username }}
                    </a>
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    @if ($user->banned_at == null)
                    <form action="{{ route('block', $user->username) }}" method="POST">
                        @csrf
                        <button class="btn btn-outline-danger">Block</button>
                    </form>
                    @else
                    <form action="{{ route('unblock', $user->username) }}" method="POST">
                        @csrf
                        <button class="btn btn-outline-danger">UnBlock</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <div style="max-width: 750px" class="mx-auto">
        {{ $users->links() }}
    </div>
</main>

@endsection
