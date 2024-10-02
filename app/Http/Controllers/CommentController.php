<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'post_id' => 'required',
            'content' => 'required',
        ]);

        $validatedData['user_id'] = $request->user()->id;

        Comment::create($validatedData);

        return redirect()->back();
    }

    public function edit(Comment $comment)
    {
        return view('pages.comment.edit', compact('comment'));
    }
    
    public function update(Request $request, Comment $comment)
    {
        $validatedData = $request->validate([
            'post_id' => 'required',
            'content' => 'required',
        ]);

        $comment->update($validatedData);

        return redirect()->back();
    }
    
    public function destroy(Comment $comment)
    {

        $comment->delete();

        return redirect()->back();
    }
}
