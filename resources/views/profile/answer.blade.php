@extends('layouts.app')

@section('content')
    <div class="container">
        @auth()
                <h4>Ответ на комментарий</h4>
                @include('inc.comment', compact('comment'))
            <form method="post" action="{{route('comments.store')}}">
                @csrf
                <input name="profile_id" value="{{$user}}" hidden>
                <input name="comment_id" value="{{$comment->id}}" hidden>
                <label>Заголовок</label>
                <input class="form-control mb-3" name="title" value="{{old('title')}}">
                <label>Текст</label>
                <textarea class="form-control mb-3" name="description">{{old('description')}}</textarea>
                <button class="btn btn-outline-dark mb-4" type="submit">Add comment</button>
            </form>

            @if ($errors->any())
                <div class="text-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endauth
    </div>
@endsection
