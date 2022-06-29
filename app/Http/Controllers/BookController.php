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
        return redirect()->route('books.show', $book->id);
    }

    public function show($bookId)
    {
        $book = Book::find($bookId);
        return view('book.show', compact('book'));
    }

    public function edit($bookId)
    {
        $book = Book::find($bookId);
        return view('book.edit', compact('book'));
    }

    public function update(UpdateRequest $request, $bookId)
    {
        $data = $request->validated();
        $book = Book::find($bookId);
        $book->update($data);
        return redirect()->route('books.show', $bookId);
    }

    public function delete($bookId)
    {
        Book::destroy($bookId);
        $user = auth()->user()->id;
        return redirect()->route('profile.library', $user);
    }
}
