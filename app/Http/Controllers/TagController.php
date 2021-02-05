<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Str;
Use Alert;

class TagController extends Controller
{
    public function index(Tag $tag)
    {
        $posts = $tag->posts()->latest()->paginate(10);
        return view('posts.explore', compact('posts', 'tag'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        Alert::success('Success', 'Tag created successfully');

        return back();
    }

    public function destroy(Tag $tag)
    {
        if($tag->posts->count() > 0){
            Alert::error('Error', "Can't delete this tag");

            return back();
        }
        $tag->posts()->delete();
        $tag->delete();

        Alert::success('Success', 'Tag deleted successfully.');

        return back();
    }

    public function search(Request $request)
    {
        if($request->ajax()){
            $keyword = $request->keyword;
            $tags = Tag::where('name', 'LIKE', '%' . $keyword . '%')->get();
            $output = '';
            if(count($tags) > 0){
                $output = '<ul class="list-group shadow">';
                foreach($tags as $tag){
                    $output .= '<li class="list-group-item"><a href="/blog/explore/tags/'. $tag->slug .'">'. $tag->name .'</a></li>';
                }
                $output .= '</ul>';
            }
            else{
                $output .= '<li class="list-group-item">No results</li>';
            }
            return $output;
        }
    }

    public function listTags()
    {
        $tags = Tag::latest()->paginate(5);
        return view('admin.tags', compact('tags'));
    }
}
