<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\{Post, Tag};
use Illuminate\Support\Facades\File;
Use Alert;

class PostController extends Controller
{
    public function index()
    {
        $posts = [];
        // Get Posts from followings
        foreach(auth()->user()->followings as $following){
            foreach($following->posts as $post){
                $posts[] = $post;
            }
        }
        // Get user's posts
        foreach(Post::with('user', 'tags')->where('user_id', auth()->user()->id)->latest()->get() as $post){
            $posts[] = $post;
        }
        // Sorting the posts
        arsort($posts);

        return view('home', compact('posts'));
    }
    public function create()
    {
        return view('posts.create', [
            'post' => new Post(),
            'tags' => Tag::get()
        ]);
    }
    public function store(PostRequest $request){
        // Get image name and extension
        $thumbnailName = time().'.'.$request->thumbnail->extension();

        // Move the image to "public/posts" folder
        $this->storeImage($request, $thumbnailName);

        // Store post into database
        $post = auth()->user()->posts()->create([
            'thumbnail' => $thumbnailName,
            'content' => $request->content,
        ]);

        // Store tags into database
        $post->tags()->attach(request('tags'));

        Alert::success('Success', 'Post created successfully.');

        return redirect('/');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', [
            'post' => $post,
            'tags' => Tag::get()
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        // Set post's thumbnail
        if(isset($request->thumbnail)){
            // Validation
            $request->validated();
            // Delete old image file in "public/posts" folder
            $this->removeImage($post);
            // Get image name and extension
            $thumbnailName = time().'.'.$request->thumbnail->extension();
            // Move the new image to "public/posts" folder
            $this->storeImage($request, $thumbnailName);
        }else{
            // if thumbnail is null, set the value same with the old thumbnail
            $thumbnailName = $post->thumbnail;
        }

        // Update the post in database
        $post->update([
            'thumbnail' => $thumbnailName,
            'content' => $request->content,
        ]);

        // Update post's tags
        $post->tags()->sync($request->tags);

        Alert::success('Success', 'Post updated successfully.');

        return redirect('/');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        // Delete all post's tags
        $post->tags()->detach();
        // Delete Post from database
        $post->delete();
        // Remove post's thumbnail from "public/posts"
        $this->removeImage($post);

        Alert::success('Success', 'Post deleted successfully.');

        return redirect('/');
    }

    public function explore()
    {
        $posts = Post::latest()->get();
        return view('posts.explore', compact('posts'));
    }

    public function storeImage($post, $thumbnailName)
    {
        $post->thumbnail->move(public_path('posts'), $thumbnailName);
    }

    public function removeImage($post)
    {
        File::delete('posts/' . $post->thumbnail);
    }
}
