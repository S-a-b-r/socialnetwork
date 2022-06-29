@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post" action="{{route('books.update', $book->id)}}">
            @csrf
            @method('patch')

            <h4>Редактирование книги {{$book->title}}</h4>
            <label>Заглавие книги</label>
            <input class="form-control mb-3" name="title" value="{{$book->title}}">
            <label>Текст книги</label>
            <textarea class="form-control mb-3" name="text" rows="20">{{$book->text}}</textarea>
            <button class="btn btn-outline-dark mb-4" type="submit">Сохранить изменения</button>
        </form>
    </div>

@endsection
