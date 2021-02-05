@extends('layouts.app')

@section('content')

<main
    class="d-flex justify-content-center align-items-center"
    style="min-height: 100vh"
>
    <div class="card login-card" style="width: 20rem">
    <div class="card-body text-center">
        <img src="source/images/logo.png" width="100" height="100" />
        <h5 class="card-title mb-4">Welcome back to Minigram</h5>
        <form action="{{ route('login') }}" method="POST" class="text-left">
        @csrf
        <div class="form-group">
            <input
            type="text"
            class="form-control bg-light"
            id="username"
            name="username"
            placeholder="Username"
            value="{{ old('username') ?? '' }}"
            />
            @error('username')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>
        <div class="form-group">
            <input
            type="password"
            class="form-control bg-light"
            id="password"
            name="password"
            placeholder="password"
            />
            @error('password')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block mb-3">
            Login
        </button>
        </form>
        <p class="mb-1">
        Don't have account?<a href="/register" class="card-link">
            Sign up here</a
        >
        </p>

        <a href="/forgot-password" class="card-link">Forgot password?</a>
    </div>
    </div>
</main>

@endsection
