@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Страница пользователя {{$user->name}}</h2>
        @auth
            @if ($user->id == auth()->user()->id)
                <div></div>
            @elseif(!$user->inAccessList(auth()->user()->id))
                <form method="post" action="{{route('access.list.add')}}">
                    @csrf
                    <input name="reader_id" value="{{$user->id}}" hidden>
                    <button class="btn btn-outline-dark mb-3" type="submit">Дать пользователю доступ к библиотеке
                    </button>
                </form>
            @else
                <form method="post" action="{{route('access.list.delete')}}">
                    @csrf
                    <input name="reader_id" value="{{$user->id}}" hidden>
                    <button class="btn btn-outline-dark mb-3" type="submit">Убрать пользователю доступ к библиотеке
                    </button>
                </form>
            @endif
            @if(auth()->user()->inAccessList($user->id))
                <a href="{{route('profile.library', $user->id)}}" class="link-secondary mb-3">Просмотреть библиотеку</a>
            @endif
        @endauth
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
            @include('inc.comment', compact('comment'))
        @endforeach
        <div id="hidden-comment-div"></div>
        <button class="link-secondary" id="btnShowAllComment">Посмотреть все комментарии</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

        $("#btnShowAllComment").click(function (event) {
            $.ajax({
                url: "../api/hiddencomments/{{$user->id}}",
                success: function (result) {
                    let out = "";
                    for (let key in result[0]) {
                        out += result[0][key];
                    }
                    $("#hidden-comment-div").html(out);

                    $("#btnShowAllComment").hide();
                }
            })
        });


    </script>
@endsection

