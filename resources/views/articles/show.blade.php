@extends('main')
@section('content')
<article>
    <h1>{{ $article->title }}</h1>
    <div>{!! $article->content !!}</div>
</article>
{!! link_to_route('main', 'Все статьи') !!}

@if (Auth::check())
<article>
    {!! link_to_route('articles.edit', 'Редактировать', $article->id) !!}
    {!! Form::open(['method' => 'DELETE', 'route' => ['articles.destroy', $article->id]]) !!}
    <button type="submit">Удалить</button>
    {!! Form::close() !!}
</article>
@endif
<div id="comments">
@foreach ($article->comments()->get() as $comment)
    <div class="comment">
        <div class="comment-author">
            {{ $comment->username }}:
            <div class="comment-date">{{ $comment->created_at }}</div>
        </div>
        <div class="comment-body">
            {!! nl2br(e($comment->body))!!}
        </div>
    </div>
@endforeach
</div>
@endsection