@extends('layouts.app')

@section('content')

<main
    class="d-flex justify-content-center align-items-center"
    style="min-height: 100vh"
>
    <div class="card login-card" style="width: 20rem">
    <div class="card-body text-center">
        <img src="{{ asset('source/images/logo.png') }}" width="100" height="100" />
        <h5 class="card-title mb-4">Change Your Password</h5>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('password.update') }}" method="POST" class="text-left">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div class="form-group">
            <input
            type="email"
            class="form-control bg-light"
            id="email"
            name="email"
            placeholder="email"
            value="{{ $request->email ?? old('email') }}"
            autofocus
            />
            @error('email')
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
            placeholder="New Password"
            />
            @error('password')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>
        <div class="form-group">
            <input
            type="password"
            class="form-control bg-light"
            id="password_confirmation"
            name="password_confirmation"
            placeholder="Confirm Password"
            />
            @error('password_confirmation')
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
