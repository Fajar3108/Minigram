@extends('layouts.app')

@section('content')

<main class="container pt-4">
      <!-- Profile -->
      <div class="row pb-4">
        <div class="col-md-6 mx-auto d-flex profile">
          <img
            src="{{ asset($user->imgProfile()) }}"
            width="150"
            height="150"
            loading="lazy"
            class="rounded mr-4 profile-img border"
            style="object-fit: cover; object-position: center;"
          />
          <div class="user-info">
            <div class="d-flex user-data align-items-center user-detail">
              <div class="mr-3 user-bio">
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
                    <button type="button" class="btn btn-outline-danger px-3" data-toggle="modal" data-target="#reportModal"><i class="fas fa-exclamation"></i></button>
                </form>
              @endif
            </div>
            <div class="d-flex align-items-center text-dark user-activity-data">
                <div class="text-center activity-data">
                <a href="{{ $user->username . '/followers' }}" class="text-dark">
                <strong>Followers</strong>
                <h4>{{ $user->followers()->count()}}</h4>
                </a>
              </div>
              <div class="text-center activity-data border-right border-left">
                <strong>Posts</strong>
                <h4>{{ $user->posts->count() }}</h4>
              </div>
              <div class="text-center activity-data">
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
      <hr class="m-0">
      <!-- Posts -->
      @if ($posts)
      <div class="row pt-4 px-2">
          @foreach ($posts as $post)
          <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-1 p-1">
              <a href="{{ route('blog.show', $post->id) }}">
                @if (strpos($post->thumbnail, 'mp4'))
                <video
                    class="d-block w-100 h-100 rounded post border"
                    style="max-height: 250px; object-fit: cover; object-position: center">
                    <source src="{{ asset('posts/' . $post->thumbnail) }}" type="video/mp4">
                </video>
                @else
                <img
                    src="{{ asset('posts/' . $post->thumbnail) }}"
                    class="d-block w-100 h-100 rounded post border"
                    style="max-height: 250px; object-fit: cover; object-position: center"
                />
                @endif
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

    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="reportModalLabel">Report &middot; {{ $user->username }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="">
                <label for="message">Message</label>
                <textarea
                name="message"
                id="message"
                class="form-control"
                rows="5"
                ></textarea>
                <button type="submit" class="btn btn-danger btn-block mt-3">Report</button>
            </form>
        </div>
        </div>
    </div>
    </div>
    </main>
@endsection
