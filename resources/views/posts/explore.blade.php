@extends('layouts.app')

@section('content')

<main class="container">
    <!-- Search -->
    <div class="search col-md-6 mx-auto pt-4">
        <div class="form-group">
            <input
            type="text"
            name="keyword"
            id="keyword"
            placeholder="Search here..."
            class="form-control"
            autofocus="on"
            autocomplete="off"
            />
        </div>
        <div id="tag_list"></div>
    </div>
    <!-- End Search -->
    @if (isset($tag))
    <div class="mb-4">
        <h4>{{ '#' . $tag->slug }}</h4><a href="/blog/explore/">Show All</a>
    </div>
    @endif
    <!-- Explore Posts -->
    <div class="row">
    <!-- Post -->
    @forelse ($posts as $post)
    <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
        <a href="{{ '/blog/' . $post->id . '/show' }}">
        <img
            src="{{ asset('posts/' . $post->thumbnail) }}"
            class="d-block w-100 h-100 rounded"
            style="max-height: 200px; object-fit: cover; object-position: center"
        />
        </a>
    </div>
    @empty
    <div class="text-center py-4 w-100">
        No Post Found &middot; <a href="/blog/explore/">Show All</a>
    </div>
    @endforelse
    <!-- End Posts -->
</main>

@endsection

@section('pageScript')
<script>
    $(document).ready(function () {

        $('#keyword').on('keyup',function() {
            var query = $(this).val();
            if(query != ''){
                $.ajax({
                    url:"{{ route('search') }}",
                    type:"GET",
                    data:{'keyword':query},

                    success:function (data) {
                        $('#tag_list').html(data);
                    }
                })
                // end of ajax call
            }
        });

        $(document).on('click', function(){
            $('#tag_list').html("");
        });
    });

</script>
@endsection
