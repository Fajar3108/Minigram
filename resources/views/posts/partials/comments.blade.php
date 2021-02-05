@foreach ($comments as $comment)
<div class="media">
    <img
    src="{{ asset($comment->user->imgProfile()) }}"
    class="mr-3 rounded-circle"
    width="32"
    height="32"
    style="object-fit: cover; object-position: center;"
    />
    <div class="media-body">
    <div class="d-flex align-items-center">
        <strong class="mt-0 mr-2"><a href="{{ '/profile/' . $comment->user->username }}" class="text-dark">{{ $comment->user->username }}</a></strong>
        @if (auth()->user()->id === $comment->user_id || auth()->user()->role === "admin")
        <form action="{{ route('comment.delete', $comment->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm text-danger btn-link">
                <i class="fas fa-trash"></i>
                delete
            </button>
        </form>
        @endif
    </div>
    <p class="mb-0">
        {{ $comment->body }} &middot; <small class="text-secondary">{{ $comment->created_at->diffForHumans() }}</small>
    </p>
    <a
        data-toggle="collapse"
        href="{{ '#replyComment' . $comment->id }}"
        role="button"
        aria-expanded="false"
        aria-controls="{{ 'replyComment' . $comment->id }}"
    >
        <i class="fas fa-reply"></i>
        Reply
    </a>
    <div class="collapse" id="{{ 'replyComment' . $comment->id }}">
        <form action="{{ route('reply.add') }}" method="POST">
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
            <input type="hidden" name="post_id" value="{{ $post_id }}" />
            <input type="hidden" name="target_id" value="{{ $comment->id }}" />
            <div class="input-group-append">
            <button class="btn btn-primary">Reply</button>
            </div>
        </div>
        </form>
        @include('posts.partials.comments', ['comments' => $comment->replies])
    </div>
    </div>
</div>
@endforeach
