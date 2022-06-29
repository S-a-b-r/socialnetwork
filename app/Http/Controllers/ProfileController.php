<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('profile.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::find($id);
        $comments = $user->comments->take(5);

        return view('profile.show', compact('comments', 'user'));
    }

    public function library($userId)
    {
        $user = User::find($userId);
        $books = Book::all()->where('author_id', '=', $userId);
        return view('profile.library', compact('books', 'user'));
    }
}
