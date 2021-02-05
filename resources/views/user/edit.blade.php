@extends('layouts.app')

@section('content')

<main class="container py-4">
      <div class="card mx-auto" style="max-width: 500px; border: none">
        <!-- Update Profile -->
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('user-profile-information.update') }}" method="POST" class="mt-3" enctype="multipart/form-data">
            @csrf
            @method('PUT')
          <div class="image-upload mb-3">
            <img
              src="{{ auth()->user()->profile_image ? asset('profiles/' . auth()->user()->profile_image ) : asset('source/images/default-profile.png') }}"
              width="150"
              height="150"
              class="rounded"
              id="imagePreview"
              style="object-fit: cover"
            />
            <input type="file" id="imageInput" name="profile_image" hidden />
            <label class="profile-input-label" for="imageInput"
              ><i class="fas fa-image fa-fw"></i
            ></label>
          </div>
          <div class="form-group">
            <input
              type="email"
              class="form-control bg-none text-secondary"
              id="email"
              value="{{ old('email') ?? auth()->user()->email }}"
              name="email"
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
              class="form-control"
              id="name"
              placeholder="Full Name"
              value="{{ old('name') ?? auth()->user()->name }}"
              name="name"
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
              class="form-control"
              id="username"
              placeholder="Username"
              value="{{ old('username') ?? auth()->user()->username }}"
              name="username"
            />
            @error('username')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary">Update Profile</button>
          <!-- Change Password -->
          <!-- End Change Password -->
          <!-- Button trigger modal -->
          <button
            type="button"
            class="btn btn-link text-primary"
            data-toggle="modal"
            data-target="#exampleModal"
          >
            Change Pasword
          </button>
        </form>
        <!-- End Update Profile -->

        <!-- Modal -->
        <div
          class="modal fade"
          id="exampleModal"
          tabindex="-1"
          aria-labelledby="exampleModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                  Change Your Password
                </h5>
                <button
                  type="button"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                >
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{ route('user-password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                  <div class="form-group">
                    <input
                      type="password"
                      class="form-control bg-light"
                      id="current_password"
                      name="current_password"
                      placeholder="Current Password"
                    />
                    @error('current_password', 'updatePassword')
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
                    @error('password', 'updatePassword')
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
                  </div>
                  <button type="submit" class="btn btn-primary btn-block mb-3">
                    Save changes
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

@endsection
