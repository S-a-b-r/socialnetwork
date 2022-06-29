@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header pt-3 d-flex">
                   <p style="font-size: 20px">{{$book->title}}</p>
                @auth()
                    @if(auth()->user()->id == $book->author->id)
                        <a href="{{route('books.edit', $book->id)}}" class="link-secondary mx-3">Редактировать</a>
                        <form method="post" action="{{route('books.delete', $book->id)}}">
                            @method('delete')
                            @csrf
                            <button style="border: 0; background-color: rgba(1,1,1,0);" type="submit"><a class="link-danger mx-3">Удалить</a></button>
                        </form>
                    @endif
                @endauth
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>{{$book->text}}</p>
                    <footer class="blockquote-footer">Автор: <cite title="Source Title">{{$book->author->name}}</cite></footer>
                </blockquote>
            </div>
        </div>
    </div>


@endsection
