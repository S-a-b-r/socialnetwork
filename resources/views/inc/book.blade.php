<div class="card mb-3">
    <div class="card-header pt-3 d-flex">
        <p style="font-size: 20px">{{$book->title}}</p>
        @auth()
            @if(auth()->user()->id == $book->author->id)
                @if($book->access_link != null)
                    <div class="mx-3"
                         style="font-size: 20px;">{{env('APP_URL') . '/books/link/' .$book->access_link}}</div>
                @else
                    <form method="post" action="{{route('books.make.link', $book)}}">
                        @csrf
                        <button type="submit" class="btn btn-outline-dark mx-3">Сгенерировать ссылку для доступа к
                            книге
                        </button>
                    </form>
                @endif
                <a href="{{route('books.edit', $book->id)}}" class="link-secondary mx-3">Редактировать</a>
                <form method="post" action="{{route('books.delete', $book->id)}}">
                    @method('delete')
                    @csrf
                    <button style="border: 0; background-color: rgba(1,1,1,0);" type="submit"><a
                            class="link-danger mx-3">Удалить</a></button>
                </form>
            @endif
        @endauth
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            <p style="height: 14rem; overflow: hidden">{{$book->text}}</p>
            <footer class="blockquote-footer">Автор: <cite title="Source Title">{{$book->author->name}}</cite></footer>
        </blockquote>
        <a href="{{route('books.show', $book->id)}}" class="link-secondary">Читать полностью</a>
    </div>
</div>
