
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
    </div>
</div>
