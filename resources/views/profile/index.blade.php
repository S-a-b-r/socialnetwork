@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Страницы пользователей</h2>
        @foreach($users as $user)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{$user->name}}</h5>
                    <p class="card-text">Комментариев на стене: {{count($user->comments)}}</p>
                    <a href="{{route('profile.show', $user->id)}}" class="card-link">Перейти к профилю</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
