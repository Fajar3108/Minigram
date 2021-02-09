@extends('layouts.app')

@section('content')

@if (auth()->user()->readNotifications->count() > 0)
<ul class="list-unstyled mx-auto px-4 my-4" style="max-width: 500px">
    @foreach(auth()->user()->readNotifications as $notification)
    <li class="media mb-3 shadow-sm p-3 rounded border align-items-center">
        <a href="{{ '/blog/' . $notification->data['post'] . '/show' }}">
            @if (strpos(App\Models\Post::find($notification->data['post'])->thumbnail, 'mp4'))
            <video
                class="mr-3 rounded" width="50" height="50"
                style="object-fit: cover; object-position:center">
                <source src="{{ asset('posts/' . App\Models\Post::find($notification->data['post'])->thumbnail ) }}" type="video/mp4">
            </video>
            @else
            <img
                src="{{ asset('posts/' . App\Models\Post::find($notification->data['post'])->thumbnail ) }}" class="mr-3 rounded" width="50" height="50"
                style="object-fit: cover; object-position:center">
            @endif
        </a>
        <div class="media-body">
            <h6 class="m-0">
                <a href="{{ '/profile/' . App\Models\User::Find($notification->data['sender'])->username }}" class="text-primary">{{ App\Models\User::Find($notification->data['sender'])->username }}</a>
                {{ $notification->data['data'] }}
            </h6>
            <small class="m-0 text-secondary">{{ $notification->created_at->diffForHumans() }}</small>
        </div>
    </li>
    @endforeach
</ul>
@else
<main class="d-flex flex-column justify-content-center align-items-center" style="height: 75vh">
    <h1 style="font-size: 72px" class="m-0 text-secondary"><i class="fas fa-laugh-wink"></i></h1>
    <h4 class="text-secondary my-4">No Notifications Found</h4>
</main>
@endif

@endsection


