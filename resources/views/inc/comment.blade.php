<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">{{$comment->title}} (Автор: {{$comment->author->name}})</h5>
        <p class="card-text">{{$comment->description}}</p>
        @if(isset($comment->comment_id))
            <p>Ответ на:</p>
            <div style="background-color: #BFBFBF; padding: 10px; border-radius: 5px" class="mb-3">
                <h5 class="card-title">{{$comment->answerTo()->title}} (Автор: {{$comment->answerTo()->name}})</h5>
                <p class="card-text">{{$comment->answerTo()->description}}</p>
            </div>
        @endif
        @auth()
        <a href="{{route('comments.answer', $comment->id)}}" class="card-link">Ответить</a>
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
