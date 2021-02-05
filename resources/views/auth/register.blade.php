@extends('layouts.app')

@section('content')

<main
      class="d-flex justify-content-center align-items-center"
      style="min-height: 100vh"
    >
      <div class="card login-card" style="width: 20rem">
        <div class="card-body text-center">
          <img src="source/images/logo.png" width="100" height="100" />
          <h5 class="card-title mb-4">Create Your Account</h5>
          <form action="{{ route('register') }}" method="POST" class="text-left">
            @csrf
            <div class="form-group">
              <input
                type="email"
                class="form-control bg-light"
                id="email"
                name="email"
                aria-describedby="emailHelp"
                placeholder="E-Mail Address"
                value="{{ old('email') ?? '' }}"
              />
              @error('email')
                  <small class="text-danger">
                      {{ $message }}
                  </small>
              @enderror
            </div>
            <div class="form-group">
              <input
                type="text"
                class="form-control bg-light"
                id="name"
                name="name"
                placeholder="Full Name"
                value="{{ old('name') ?? '' }}"
              />
              @error('name')
                  <small class="text-danger">
                      {{ $message }}
                  </small>
              @enderror
            </div>
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
            <div class="form-group">
              <input
                type="password"
                class="form-control bg-light"
                id="confirmPassword"
                name="password_confirmation"
                placeholder="Confirm Password"
              />
            </div>
            <button type="submit" class="btn btn-primary btn-block mb-3">
              Register
            </button>
          </form>
          <p class="mb-1">
            Already have account?<a href="/login" class="card-link">
              Sign in here</a
            >
          </p>
        </div>
      </div>
    </main>

@endsection
