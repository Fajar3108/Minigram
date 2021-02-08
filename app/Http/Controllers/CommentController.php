<?php

namespace App\Http\Controllers;

use App\Models\{Post, Comment};
use Illuminate\Http\Request;
Use Alert;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment;

        if(isset($request->comment)){
            $comment->body = $request->comment;
            $comment->user()->associate($request->user());
            $post = Post::find($request->post_id);
            $post->comments()->save($comment);
        }else{
            Alert::error('ERROR', "Comment can't be null");
        }

        return back();
    }
    public function replyStore(Request $request)
    {
        $reply = new Comment();

        if(isset($request->comment)){
            $reply->body = $request->comment;
            $reply->user()->associate($request->user());
            $reply->target_id = $request->target_id;
            $post = Post::find($request->post_id);
            $post->comments()->save($reply);
        }else{
            Alert::error('ERROR', "Comment can't be null");
        }

        return back();
    }

    public function destroy(Comment $comment)
    {
        if(auth()->user()->id === $comment->user_id || auth()->user()->role === "admin"){
            $comment->delete();
            return redirect()->back();
        }else{
            abort(403, "This is not your comment");
        }
    }
}
