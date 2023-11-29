<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Supprt\Facades\Validator;
use App\Services\CommentService;

class CommentController extends Controller
{
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(CommentRequest $request)
    {
        info(auth()->user()->id);
        $comment = $this->commentService->saveComment($request);
        return back();
    }

    public function destroy($id)
    {
        $comment = $this->commentService->deleteComment($id);
        return back();
    }

    public function edit($id)
    {
        $editComment = $this->commentService->getCommentById($id);
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
        $comment = $this->commentService->updateComment($request, $id);
        return back();
    }
}