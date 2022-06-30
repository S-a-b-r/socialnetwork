<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\StoreRequest;
use App\Http\Requests\Book\UpdateRequest;
use App\Models\Book;
use App\Models\User;

class BookController extends Controller
{


    public function create()
    {
        return view('book.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $book = Book::firstOrCreate($data);
        return redirect()->route('books.show', $book);
    }

    public function show(Book $book)
    {
        return view('book.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('book.edit', compact('book'));
    }

    public function update(UpdateRequest $request, Book $book)
    {
        $data = $request->validated();
        $book->update($data);
        return redirect()->route('books.show', $book);
    }

    public function delete(Book $book)
    {
        $user = auth()->user();
        if($user->id == $book->author_id){
            $book->delete();
        }
        return redirect()->route('profile.library', $user);
    }
}
