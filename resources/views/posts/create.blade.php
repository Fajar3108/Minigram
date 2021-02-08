@extends('layouts.app')

@section('content')

<main class="container py-4">
      <div class="card login-card mx-auto" style="max-width: 500px">
        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
            <label for="imageInput">Thumbnail</label>
            <div class="image-upload mb-3 rounded border" style="width: 100%; height: 300px;">
              <img
                src=""
                class="rounded"
                id="imagePreview"
                style="width: 100%; height: 300px; object-fit: cover; object-position: center;"
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
            ></textarea>
          </div>
          <div class="form-group">
            <label for="tags">Tags</label>
            <select
              class="tags-multiple form-control"
              name="tags[]"
              multiple="multiple"
              id="tags"
            >
            @foreach ($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
            </select>
          </div>

          <button type="submit" class="btn btn-primary btn-block">Add New Post</button>
        </form>
      </div>
    </main>

@endsection
