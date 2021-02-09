@extends('layouts.app')

@section('content')

<main class="container py-4">
    @include('admin.partials.tabs')
    <div class="table-responsive">
    <table class="table my-4 mx-auto" style="width: 750px">
        <thead>
            <tr>
            <th scope="col">Reporter</th>
            <th scope="col">Message</th>
            <th scope="col">Target</th>
            <th scope="col">Reported at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
            <tr>
                <td>
                    <a href="{{ '/profile/' . $report->reporter->username }}">
                        <img
                        src="{{ asset($report->reporter->imgProfile()) }}"
                        width="32"
                        height="32"
                        loading="lazy"
                        class="rounded-circle mr-1 profile-img"
                        style="object-fit: cover; object-position: center;"
                    />
                        {{ $report->reporter->username }}
                    </a>
                </td>
                <td>{{ $report->message }}</td>
                <td>
                    <a href="{{ '/profile/' . $report->target->username }}">
                        <img
                        src="{{ asset($report->target->imgProfile()) }}"
                        width="32"
                        height="32"
                        loading="lazy"
                        class="rounded-circle mr-1 profile-img"
                        style="object-fit: cover; object-position: center;"
                    />
                        {{ $report->target->username }}
                    </a>
                </td>
                <td>{{ $report->created_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <div style="max-width: 750px" class="mx-auto">
        {{ $reports->links() }}
    </div>
</main>

@endsection
