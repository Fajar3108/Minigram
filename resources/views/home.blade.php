@extends('layouts.app')

@section('content')

<!-- Main -->
    @if ($posts)
    <main class="container">
      <!-- Posts -->
        @foreach ($posts as $post)
      <div
        class="row mt-4 mx-auto shadow m-2 rounded border">
        <div class="col-md-6 py-3 border-bottom">
          <a href="{{ route('blog.show', $post->id) }}">
          <img
            src="{{ asset('posts/'. $post->thumbnail) }}"
            class="d-block w-100 border rounded post-home"
          />
          </a>
        </div>
        <div class="col-md-6 py-3">
          <div class="media align-items-center">
            <img
              src="{{ asset($post->user->imgProfile()) }}"
              width="32"
              height="32"
              class="mr-3 rounded-circle border"
              style="object-fit: cover; object-position: center;"
            />
            <div class="media-body d-flex justify-content-between">
              <strong class="m-0"
                ><a href="{{ '/profile/' . $post->user->username }}" class="text-dark">{{ $post->user->username }}</a></strong
              >
              @if(auth()->user()->id === $post->user_id || auth()->user()->role === "admin")
              <a href="{{ route('blog.edit', $post->id) }}"> <i class="fas fa-edit"></i> Edit </a>
              @endif
            </div>
          </div>
          <p class="pt-3 m-0">
              <small class="text-secondary m-0">{{ $post->created_at->diffForHumans() }}</small>
          </p>
          <p class="text-dark">
            @if (isset($post->content))
            {!! \Str::limit($post->content, 170) !!}
            <a href="{{ route('blog.show', $post->id) }}">Read More</a>
            @endif
          </p>
          <p>
            @foreach ($post->tags as $tag)
            <a href="{{ '/blog/explore/tags/' . $tag->slug }}">{{ '#' . $tag->slug }}</a>
            @endforeach
          </p>
          <a href="{{ '/blog/' . $post->id . '/show?#comments' }}" class="text-dark"
            ><i class="fas fa-comment-dots"></i> Comments</a
          >
        </div>
      </div>
      @endforeach
    </main>
    @else
    <main class="d-flex flex-column justify-content-center align-items-center" style="height: 75vh">
        <h1 style="font-size: 72px" class="m-0 text-secondary"><i class="fas fa-laugh-wink"></i></h1>
        <h4 class="text-secondary my-4">Create Your First Post</h4>
        <a href="/blog/create" class="btn btn-primary">Add New Post</a>
    </main>
    @endif
    <!-- END Main -->

@endsection
