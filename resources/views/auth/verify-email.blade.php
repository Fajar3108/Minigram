@extends('layouts.app')

@section('content')

<main
      class="d-flex justify-content-center align-items-center"
      style="min-height: 100vh"
    >
      <div class="card login-card" style="width: 20rem">
        <div class="card-body text-center">
          <img src="{{ asset('source/images/logo.png') }}" width="100" height="100" />
          <h5 class="card-title mb-4">Verify Your Email</h5>
            @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                A new email verification link has been emailed to you!
            </div>
            @endif
          <form action="{{ route('verification.send') }}" method="POST" class="text-left">
            @csrf
            <button type="submit" class="btn btn-primary btn-block mb-3">
              Resend Email Verification Link
            </button>
          </form>
        </div>
      </div>
    </main>

@endsection
