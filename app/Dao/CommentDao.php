<?php

namespace App\Dao;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentDao
{

    public function saveComment($request)
    {
        if (Post::where('id', $request->post_slug)->exists()) {
            $comment = Comment::create([
                'user_id' => Auth::user()->id,
                'post_id' => $request->post_slug,
                'comment' => $request->comment,
                'parent_id' => $request->parent_id,
            ]);
        }
        return $comment;
    }

    public function getCommentById($id)
    {
        $comment = Comment::find($id);
        return $comment;
    }

    public function updateComment($request, $id)
    {
        $comment = Comment::where('id', $id)->update([
            'comment' => $request->updatecomment
        ]);
        return $comment;
    }

    public function deleteComment($id)
    {
        $comment = $this->getCommentById($id);
        $comment->delete();
        return $comment;
    }

}