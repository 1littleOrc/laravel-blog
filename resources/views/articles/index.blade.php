@extends('main')
@section('content')
{!! link_to_route('articles.create', 'Новый пост') !!}

@foreach ($articles as $article)
    <article>
        <h3>
            @if ($article->path) {!! link_to_route('post', $article->title, $article->path) !!}
            @else{!! link_to_route('post_by_id', $article->title, $article->id) !!}
            @endif
        </h3>

        @if (Auth::check())
        <div>
            {!! link_to_route('articles.edit', 'Редактировать', $article->id) !!}
            {!! Form::open(['method' => 'DELETE', 'route' => ['articles.destroy', $article->id]]) !!}
            <button type="submit">Удалить</button>
            {!! Form::close() !!}
        </div>
        @endif

        {!! $article->small !!}
        <div>Комментариев: {{ $article->comments }}</div>
    </article>

    <hr>
    @endforeach

<!-- pagination -->
{!! $articles->render() !!}
@endsection