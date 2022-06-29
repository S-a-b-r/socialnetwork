@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post" action="{{route('books.store')}}">
            @csrf

            <h4>Вы можете написать свою книгу</h4>
            <input name="author_id" value="{{auth()->user()->id}}" hidden>
            <label>Заглавие книги</label>
            <input class="form-control mb-3" name="title" value="{{old('title')}}">
            <label>Текст книги</label>
            <textarea class="form-control mb-3" name="text" rows="20">{{old('description')}}</textarea>
            <button class="btn btn-outline-dark mb-4" type="submit">Add book</button>
        </form>
    </div>

@endsection
