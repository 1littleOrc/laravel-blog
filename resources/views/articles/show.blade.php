@extends('main')
@section('content')
<article>
    <h1>{{ $article->title }}</h1>
    <div>{!! $article->content !!}</div>
</article>
{!! link_to_route('articles.index', 'Все статьи') !!}
@endsection