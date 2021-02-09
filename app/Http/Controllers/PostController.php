<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Post, Tag};
use Illuminate\Support\Facades\File;
Use Alert;

class PostController extends Controller
{
    public function index()
    {
        $posts = [];
        foreach(auth()->user()->followings as $following){
            foreach($following->posts as $post){
                $posts[] = $post;
            }
        }
        foreach(Post::with('user', 'tags')->where('user_id', auth()->user()->id)->latest()->get() as $post){
            $posts[] = $post;
        }
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
    public function store(Request $request){
        $request->validate([
            'thumbnail' => 'required|mimes:jpeg,png,jpg,gif,svg,mp4|max:30720'
        ]);

        $thumbnailName = time().'.'.$request->thumbnail->extension();
        $request->thumbnail->move(public_path('posts'), $thumbnailName);

        $post = auth()->user()->posts()->create([
            'user_id' => auth()->user()->id,
            'thumbnail' => $thumbnailName,
            'content' => $request->content,
        ]);

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
        if(auth()->user()->id === $post->user_id || auth()->user()->role === "admin"){
            return view('posts.edit', [
                'post' => $post,
                'tags' => Tag::get()
            ]);
        }else{
            abort(403, "This is not your post");
        }
    }

    public function update(Request $request, Post $post)
    {
        if(auth()->user()->id === $post->user_id || auth()->user()->role === "admin"){
            if(isset($request->thumbnail)){
            $request->validate([
                'thumbnail' => 'required|mimes:jpeg,png,jpg,gif,svg,mp4|max:30720'
            ]);
            File::delete('posts/' . $post->thumbnail);
            $thumbnailName = time().'.'.$request->thumbnail->extension();
            $request->thumbnail->move(public_path('posts'), $thumbnailName);
            }else{
                $thumbnailName = $post->thumbnail;
            }

            $post->update([
                'thumbnail' => $thumbnailName,
                'content' => $request->content,
            ]);

            $post->tags()->sync($request->tags);

            Alert::success('Success', 'Post updated successfully.');

            return redirect('/');
        }else{
            abort(403, "This is not your post");
        }

    }

    public function destroy(Post $post)
    {
        if(auth()->user()->id === $post->user_id || auth()->user()->role === "admin"){
            $post->tags()->detach();
            $post->delete();
            File::delete('posts/' . $post->thumbnail);
            Alert::success('Success', 'Post deleted successfully.');
            return redirect('/');
        }else{
            abort(403, "This is not your post");
        }
    }

    public function explore()
    {
        $posts = Post::latest()->get();
        return view('posts.explore', compact('posts'));
    }
}
