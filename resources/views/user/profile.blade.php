@extends('layouts.app')

@section('content')

<main class="container py-4">
      <!-- Profile -->
      <div class="row pb-4">
        <div class="col-md-6 mx-auto d-flex profile">
          <img
            src="{{ asset($user->imgProfile()) }}"
            width="150"
            height="150"
            loading="lazy"
            class="rounded mr-4 profile-img"
            style="object-fit: cover; object-position: center; border: 1px solid #707070;"
          />
          <div class="user-info">
            <div class="d-flex user-data align-items-center">
              <div class="mr-3">
                <h3 class="mb-0">{{ $user->name }}</h3>
                <h5 class="text-secondary">{{ $user->username }}</h5>
              </div>
              @if (auth()->user()->id != $user->id)
                <form action="{{ route('follow') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <button class="btn {{ auth()->user()->isFollowing($user) ? ' btn-outline-danger' : 'btn-primary' }}" type="submit">
                    {{ auth()->user()->isFollowing($user) ? 'UnFollow' : 'Follow' }}
                    </button>
                </form>
              @endif
            </div>
            <div class="d-flex align-items-center user-activity-data text-dark">
              <div class="text-center">
                <strong>Posts</strong>
                <h4>{{ $user->posts->count() }}</h4>
              </div>
              <div class="text-center px-4">
                <a href="{{ $user->username . '/followers' }}" class="text-dark">
                <strong>Followers</strong>
                <h4>{{ $user->followers()->count()}}</h4>
                </a>
              </div>
              <div class="text-center">
                <a href="{{ $user->username . '/followings' }}" class="text-dark">
                <strong>Following</strong>
                <h4>{{ $user->followings()->count() }}</h4>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Profile -->
      <hr>
      <!-- Posts -->
      @if ($posts)
      <div class="row py-4">
          @foreach ($posts as $post)
          <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
              <a href="{{ route('blog.show', $post->id) }}">
                <img
                src="{{ asset('posts/' . $post->thumbnail) }}"
                class="d-block w-100 h-100 rounded"
                style="object-fit: cover; object-position: center"
                />
            </a>
        </div>
        @endforeach
    </div>
    @else
    <!-- End Posts -->
    <div class="d-flex flex-column justify-content-center align-items-center" style="height: 50vh">
        <h1 style="font-size: 72px" class="m-0 text-secondary"><i class="fas fa-laugh-wink"></i></h1>
        <h4 class="text-secondary my-4">No Posts Found</h4>
    </div>
    @endif
    </main>
@endsection
