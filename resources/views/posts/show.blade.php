@extends('layouts.app')

@section('content')
<main class="col-md-6 mx-auto py-4">
    @if (strpos($post->thumbnail, 'mp4'))
    <video
        class="rounded"
        style="width: 100%; height: 300px; object-fit: cover; object-position: center;"
        controls>
        <source src="{{ asset('posts/' . $post->thumbnail) }}" type="video/mp4">
    </video>
    @else
    <img
    src="{{ asset('posts/' . $post->thumbnail) }}"
    class="d-block w-100"
    style="max-height: 500px; object-fit: cover; object-position:center"
    />
    @endif
    <div class="media py-2 align-items-center">
    <img
        src="{{ asset($post->user->imgProfile()) }}"
        width="32"
        height="32"
        class="mr-3 rounded-circle"
        style="object-fit: cover; object-position: center;"
    />
    <div class="media-body d-flex justify-content-between">
        <strong class="m-0"
        ><a href="{{ '/profile/' . $post->user->username }}" class="text-dark">{{ $post->user->username }}</a></strong
        >
        @if(auth()->user()->id === $post->user_id || auth()->user()->role === "admin")
        <a href="{{ route('blog.edit', $post->id) }}"> <i class="fas fa-edit"></i> Edit </a>
        @else
        <a href="#comments"><i class="fas fa-comment-dots"></i> Comments</a>
        @endif
    </div>
    </div>
    <p class="m-0">
        <small class="text-secondary m-0">{{ $post->created_at->diffForHumans() }}</small>
    </p>
    <p class="text-dark">
        {!! nl2br($post->content) !!}
    </p>
    <p>
    @foreach ($post->tags as $tag)
    <a href="{{ '/blog/explore/tags/' . $tag->slug }}">{{ '#' . $tag->slug }}</a>
    @endforeach
    </p>
    <strong id="comments"
    ><i class="fas fa-comment-dots"></i> Comments</strong
    >
    <form action="{{ route('comment.add') }}" method="POST">
    @csrf
    <div class="input-group my-3">
        <input
        type="text"
        class="form-control"
        placeholder="Enter Your Comment"
        aria-label="Enter Your Comment"
        aria-describedby="basic-addon2"
        name="comment"
        />
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <div class="input-group-append">
        <button class="btn btn-primary" type="submit">Send</button>
        </div>
    </div>
    </form>

    <!-- Comments -->
    @include('posts.partials.comments', ['comments' => $post->comments, 'post_id' => $post->id])
    <!-- End Comments -->
</main>
@endsection
