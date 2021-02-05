@extends('layouts.app')

@section('content')

<main class="container py-4">
    @include('admin.partials.tabs')
    <div class="table-responsive">
    <table class="table my-4 mx-auto" style="width: 500px">
        <thead>
            <tr>
            <th scope="col">Username</th>
            <th scope="col">email</th>
            <th scope="col">Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
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
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</main>

@endsection
