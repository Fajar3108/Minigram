@extends('layouts.app')

@section('content')
@if($user->followers->count() > 0 || $user->followings->count() > 0)
    <main>
        <ul class="list-unstyled mx-auto px-4 my-4" style="max-width: 500px">
        <h4 class="m-0 mb-3">
            <a href="{{ '/profile/' . $user->username }}" class="text-primary">
                {{ $user->username }}
                {{ $user == auth()->user() ? ' (You)' : '' }}
            </a>
            &middot;
            {{ request()->is('profile/*/followers') ? 'Followers' : 'Followings' }}
        </h4>
        @if (request()->is('profile/*/followers'))
            @foreach ($user->followers as $follow)
            <a href="{{ '/profile/' . $follow->username }}" class="text-dark">
                <li class="media mb-3 shadow p-3 rounded">
                    <img src="{{ $follow->profile_image ? asset('profiles/' . $follow->profile_image ) : asset('source/images/default-profile.png') }}" class="mr-3 rounded-circle" width="32" height="32"
                    style="object-fit: cover; object-position:center">
                    <div class="media-body">
                        <h5 class="m-0">{{ $follow->name }}</h5>
                        <p class="m-0">{{ $follow->username }}</p>
                    </div>
                </li>
            </a>
            @endforeach
        @elseif(request()->is('profile/*/followings'))
            @foreach ($user->followings as $follow)
            <a href="{{ '/profile/' . $follow->username }}" class="text-dark">
                <li class="media mb-3 shadow p-3 rounded">
                    <img src="{{ $follow->profile_image ? asset('profiles/' . $follow->profile_image ) : asset('source/images/default-profile.png') }}" class="mr-3 rounded-circle" width="32" height="32"
                    style="object-fit: cover; object-position:center">
                    <div class="media-body">
                        <h5 class="m-0">{{ $follow->name }}</h5>
                        <p class="m-0">{{ $follow->username }}</p>
                    </div>
                </li>
            </a>
            @endforeach
        @endif
        </ul>
    </main>
@else
<main class="d-flex flex-column justify-content-center align-items-center" style="height: 75vh">
    <h1 style="font-size: 72px" class="m-0 text-secondary"><i class="fas fa-frown"></i></h1>
    <h4 class="text-secondary my-4">
        {{ request()->is('profile/*/followers') ? 'No one Follow you' : 'Follow someone now' }}
    </h4>
</main>
@endif
@endsection
