<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['author_id'] = auth()->user()->id;
        Comment::firstOrCreate($data);

        return redirect()->route('profile.show', $data['profile_id']);
    }

    public function delete($idComment){
        Comment::destroy($idComment);
        return back();
    }
}
