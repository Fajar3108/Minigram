@extends('layouts.app')

@section('content')

<ul class="list-unstyled mx-auto px-4 my-4" style="max-width: 500px">
    @foreach(auth()->user()->readNotifications as $notification)
    <li class="media mb-3 shadow-sm p-3 rounded border align-items-center">
        <a href="{{ '/blog/' . $notification->data['post'] . '/show' }}">
            <img src="{{ asset('posts/' . App\Models\Post::find($notification->data['post'])->thumbnail ) }}" class="mr-3 rounded" width="50" height="50"
            style="object-fit: cover; object-position:center">
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

@endsection


