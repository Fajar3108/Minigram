@extends('layouts.app')

@section('content')

<main class="container py-4">
      <div class="card login-card mx-auto" style="max-width: 500px">
        <form action="{{ route('blog.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
            <label for="imageInput">Thumbnail</label>
            <div class="image-upload mb-3" style="width: 100%">
              <img
                src="{{ asset('posts/' . $post->thumbnail) }}"
                class="rounded"
                id="imagePreview"
                style="width: 100%; max-height: 300px; object-fit: cover; object-position: center;"
              />
              <input type="file" name="thumbnail" id="imageInput" hidden />
              <label class="profile-input-label" for="imageInput"
                ><i class="fas fa-image fa-fw"></i
              ></label>
            </div>
            @error('thumbnail')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
          </div>
          <div class="form-group">
            <label for="content">Content</label>
            <textarea
              name="content"
              id="content"
              class="form-control"
              rows="5"
              name="content"
            >{{ $post->content }}</textarea>
          </div>
          <div class="form-group">
            <label for="tags">Tags</label>
            <select
              class="tags-multiple form-control"
              name="tags[]"
              multiple="multiple"
              id="tags"
            >
            @foreach ($post->tags as $tag)
            <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
            @endforeach
            @foreach ($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
            </select>
          </div>

          <button type="submit" class="btn btn-primary px-3">Update</button>
          <button type="button" class="btn text-danger px-3" data-toggle="modal" data-target="#deleteModal">Delete</button>
        </form>
        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Are you sure?</h5>
                <form action="{{ route('blog.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn text-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
            </div>
        </div>
        </div>
      </div>
    </main>

@endsection
