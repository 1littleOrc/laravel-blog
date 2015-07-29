@extends('main')
@section('content')
<article>
    <h1>{{ $article->title }}</h1>
    <div>{!! $article->content !!}</div>
</article>
{!! link_to_route('articles.index', 'Все статьи') !!}

@if (Auth::check())
<article>
    {!! link_to_route('articles.edit', 'Редактировать', $article->id) !!}
    {!! Form::open(['method' => 'DELETE', 'route' => ['articles.destroy', $article->id]]) !!}
    <button type="submit">Удалить</button>
    {!! Form::close() !!}
</article>
@endif

@endsection