<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">{{$comment->title}} (Автор: {{$comment->author->name}})</h5>
        <p class="card-text">{{$comment->description}}</p>
        @if(isset($comment->comment_id))
            <p>Ответ на:</p>
            @if(!empty($comment->answerTo()[0]))
                <div style="background-color: #BFBFBF; padding: 10px; border-radius: 5px" class="mb-3">
                    <h5 class="card-title">{{$comment->answerTo()[0]->title}} (Автор: {{$comment->answerTo()[0]->name}})</h5>
                    <p class="card-text">{{$comment->answerTo()[0]->description}}</p>
                </div>
            @else
                <div style="background-color: #BFBFBF; padding: 10px; border-radius: 5px" class="mb-3">
                    <p>Комментарий был удален</p>
                </div>
            @endif
        @endif
        @auth()
        <a href="{{route('comments.answer', $comment)}}" class="card-link">Ответить</a>
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
