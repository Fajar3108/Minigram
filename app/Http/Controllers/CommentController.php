<?php

namespace App\Http\Controllers;

use App\Models\{Post, Comment, User};
use Illuminate\Http\Request;
Use Alert;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment;

        if(!isset($request->comment)){
            Alert::error('ERROR', "Comment can't be null");
            return back();
        }

        $comment->body = $request->comment;
        $comment->user()->associate($request->user());
        $post = Post::find($request->post_id);
        $post->comments()->save($comment);

        if($post->user_id != auth()->user()->id){
            $details = [
                'sender' => $comment->user->id,
                'body' => 'Comment your post',
                'post' => $request->post_id,
            ];
            $this->sendNotification($post->user, $details);
        }

        return back();
    }
    public function replyStore(Request $request)
    {
        $reply = new Comment();

        if(isset($request->comment)){
            Alert::error('ERROR', "Comment can't be null");
            return back();
        }

        $reply->body = $request->comment;
        $reply->user()->associate($request->user());
        $reply->target_id = $request->target_id;

        $post = Post::find($request->post_id);
        $post->comments()->save($reply);

        $comemntTarget = Comment::find($request->target_id);
        $targetReply = User::find($comemntTarget->user_id);

        if(auth()->user()->id != $targetReply->id){
            $details = [
                'sender' => auth()->user()->id,
                'body' => 'Reply your comment',
                'post' => $request->post_id,
            ];
            $this->sendNotification($targetReply, $details);
        }

        return back();
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();
        return redirect()->back();
    }

    public function sendNotification($targetNotif, $details)
    {
        $targetNotif->notify(new \App\Notifications\UserNotification($details));
    }
}
