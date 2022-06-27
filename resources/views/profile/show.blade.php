@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Страница пользователя {{$user->name}}</h2>
        @auth()
            <form method="post" action="{{route('comments.store')}}">
                <h4>Вы можете оставить свой комментарий</h4>
                @csrf
                <input name="profile_id" value="{{$user->id}}" hidden>
                <label>Заголовок</label>
                <input class="form-control mb-3" name="title" value="{{old('title')}}">
                <label>Текст</label>
                <textarea class="form-control mb-3" name="description">{{old('description')}}</textarea>
                <button class="btn btn-outline-dark mb-4" type="submit">Add comment</button>
            </form>
        @endauth
        @foreach($comments as $comment)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{$comment->title}} (Автор: {{$comment->author->name}})</h5>
                    <p class="card-text">{{$comment->description}}</p>
                    <a href="#" class="card-link">Ответить</a>
                    @auth()
                        @if((auth()->user()->id == $comment->author->id) ||(auth()->user()->id == $comment->profile->id))
                            <form method="post" action="{{route('comments.delete', $comment)}}">
                                @method('delete')
                                @csrf
                                <button style="border: 0; background-color: rgba(1,1,1,0);" type="submit"><a class="link-danger">Удалить</a></button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        @endforeach
        <a class="link-secondary" href="#">Посмотреть все комментарии</a>
    </div>
@endsection
