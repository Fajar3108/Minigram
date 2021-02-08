@extends('layouts.app')

@section('content')

<main class="container py-4">
    @include('admin.partials.tabs')

    <div class="mx-auto pt-4" style="width: 500px">
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addNewTag">Add New Tag</button>
    </div>

    <div class="table-responsive">
    <table class="table my-4 mx-auto" style="width: 500px">
        <thead>
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Tag</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
            <tr>
                <td>{{ $tag->name }}</td>
                <td>{{ '#' . $tag->slug }}</td>
                <td>
                    <form action="/tag/delete/{{ $tag->id }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <div style="max-width: 500px" class="mx-auto">
        {{ $tags->links() }}
    </div>
    <!-- Add New Tag Modal -->
    <div class="modal fade" id="addNewTag" tabindex="-1" aria-labelledby="addTagTitle" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addTagTitle">Add New Tag</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="/tag/store" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Tag Name" class="form-control">
                <button type="submit" class="btn btn-block btn-primary mt-3">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</main>


@endsection
