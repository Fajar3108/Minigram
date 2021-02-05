@extends('layouts.app')

@section('content')

<main
      class="d-flex justify-content-center align-items-center"
      style="min-height: 100vh"
    >
      <div class="card login-card" style="width: 20rem">
        <div class="card-body text-center">
          <img src="source/images/logo.png" width="100" height="100" />
          <h5 class="card-title mb-4">Reset Your Password</h5>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
          <form action="{{ route('password.email') }}" method="POST" class="text-left">
            @csrf
            <div class="form-group">
              <input
                type="text"
                class="form-control bg-light"
                id="email"
                name="email"
                placeholder="E-Mail Address"
              />
              @error('email')
                  <small class="text-danger">
                      {{ $message }}
                  </small>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-block mb-3">
              Reset Password
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
