<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index()
    {
        $author = auth()->user()->id;
        $comments = Comment::where('author_id', '=', $author)->get();
        return view('comment.index', compact('comments'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['author_id'] = auth()->user()->id;
        Comment::firstOrCreate($data);

        return redirect()->route('profile.show', $data['profile_id']);
    }

    public function answer( Comment $comment)
    {
        $user = $comment->author->id;
        return view('profile.answer', compact('comment', 'user'));
    }

    public function delete(Comment $comment)
    {
        if($comment->author_id == auth()->user()->id){
            $comment->delete();
        }
        return back();
    }

    public function getHidden($userId)
    {
        $comments = User::find($userId)->comments->skip(5);
        $views_comment = [];

        foreach ($comments as $comment) {
            $views_comment[] = view('inc.new_comment', compact('comment'))->render();
        }
        return response()->json([$views_comment]);
    }
}
