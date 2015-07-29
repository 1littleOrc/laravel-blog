@extends('main')
@section('content')
{!! link_to_route('articles.create', 'Новый пост') !!}

@foreach ($articles as $article)
    <article>
        <h3>{!! link_to_route('articles.show', $article->title, $article->id) !!}</h3>

        <div>
            {!! link_to_route('articles.edit', 'Редактировать', $article->id) !!}
            {!! Form::open(['method' => 'DELETE', 'route' => ['articles.destroy', $article->id]]) !!}
            <button type="submit">Удалить</button>
            {!! Form::close() !!}
        </div>

        {!! $article->small !!}
        <div>Комментариев: {{ $article->comments }}</div>
    </article>

    <hr>
    @endforeach

<!-- pagination -->
{!! $articles->render() !!}
@endsection