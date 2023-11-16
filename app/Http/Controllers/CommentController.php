<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Supprt\Facades\Validator;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        info(auth()->user()->id);

        if (Post::where('id', $request->post_slug)->exists()) {
            Comment::create([
                'user_id' => Auth::user()->id,
                'post_id' => $request->post_slug,
                'comment' => $request->comment,
                'parent_id' => $request->parent_id,
            ]);
        }
        return back();

    }


    public function delete($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return back();
    }

    public function edit($id)
    {
        $editComment = Comment::find($id);
        return back()->with(['comment' => $editComment->comment]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'updatecomment' => "required|max:255"
        ], [
                'updatecomment.required' => 'Update comment field is required',
                'updatecomment.max' => 'Update comment must be less than 255 words'
            ]);
        Comment::where('id', $id)->update([
            'comment' => $request->updatecomment
        ]);
        return back();
    }
}