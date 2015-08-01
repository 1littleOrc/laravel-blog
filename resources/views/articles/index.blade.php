@extends('main')

@section('content')
    <div class="articles">
    @foreach ($articles as $article)
        <div class="row">
            <article>
                <h3>
                    @if ($article->path) {!! link_to_route('post', $article->title, $article->path) !!}
                    @else{!! link_to_route('post_by_id', $article->title, $article->id) !!}
                    @endif
                </h3>

                <div class="stars">
                    <div class="date">
                        {{ $article->getDate() }}
                    </div>
                    @include('articles.rating', ['id' => $article->id, 'value' => $article->rating])
                </div>
                @if (Auth::check())
                    <div>

                        {!! Form::open(['method' => 'DELETE', 'route' => ['articles.destroy', $article->id]]) !!}
                        <button type="submit" class="btn btn-default">Удалить</button>
                        {!! link_to_route('articles.edit', 'Редактировать', $article->id, ['class' => 'btn btn-default']) !!}
                        {!! Form::close() !!}
                    </div>
                @endif

                {!! $article->small !!}

                <div>
                    @if ($article->path) {!! link_to_route('post', $article->comments .' '
                        . Lang::choice('комментарий|комментария|комментариев', $article->comments), $article->path) !!}
                    @else{!! link_to_route('post_by_id', 'Комментариев: ' . $article->comments, $article->id) !!}
                    @endif </div>
            </article>

        </div>
    @endforeach

    <!-- pagination -->
    {!! $articles->render() !!}
    </div>
@endsection