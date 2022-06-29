@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Ваши комментарии</h2>

        @foreach($comments as $comment)
            @include('inc.comment', compact('comment'))
        @endforeach

    </div>
@endsection
