@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Библиотека автора {{$user->name}}</h2>

        @auth()
            @if(auth()->user()->id == $user->id)
                <a href="{{route('books.create')}}"><button class="btn btn-outline-dark mb-4">Добавить новую книгу</button></a>
            @endif
        @endauth
    @foreach($books as $book)
            @include('inc.book', compact('book'))
        @endforeach
    </div>
@endsection
