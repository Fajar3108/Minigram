@extends('layouts.app')

@section('content')

<main class="container py-4">
    @include('admin.partials.tabs')
    <div class="card text-white bg-primary mb-1 mx-auto mt-4" style="max-width: 18rem;">
        <div class="card-body">
            <h1 class="card-title">{{ $users }}</h1>
            <p class="card-text">Total Users</p>
        </div>
    </div>
    <div class="card text-white bg-success mb-1 mx-auto" style="max-width: 18rem;">
        <div class="card-body">
            <h1 class="card-title">{{ $posts }}</h1>
            <p class="card-text">Total Posts</p>
        </div>
    </div>
    <div class="card text-white bg-danger mb-3 mx-auto" style="max-width: 18rem;">
        <div class="card-body">
            <h1 class="card-title">{{ $admins }}</h1>
            <p class="card-text">Total Admins</p>
        </div>
    </div>
</main>

@endsection
