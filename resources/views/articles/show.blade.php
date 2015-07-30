@extends('main')

@section('content')
<article>
    <h1 style="font-size: 20px;">{{ $article->title }}</h1>
    <div class="date">{{ $article->getDate() }}</div>
    <div>{!! $article->content !!}</div>
</article>


@if (Auth::check())
    <div>
        {!! Form::open(['method' => 'DELETE', 'route' => ['articles.destroy', $article->id]]) !!}
        <button type="submit" class="btn btn-default">Удалить</button>
        {!! link_to_route('articles.edit', 'Редактировать', $article->id, ['class' => 'btn btn-default']) !!}
        {!! Form::close() !!}
    </div>
@endif

<div id="comments">
    @if ($article->comments()->count())
        <div class="row" style="font-size: 20px;margin: 20px">Комментарии</div>
        @foreach ($article->comments()->get() as $comment)
            <div class="comment" id="comment{{ $comment->id }}">
                <div class="comment-author">
                    {{ $comment->username }}:
                    <div class="comment-date">{{ $comment->created_at }}</div>
                </div>
                <div class="comment-body">
                    {!! nl2br(e($comment->body))!!}
                </div>
                @if (Auth::check())
                    <button class="btn btn-default del-comment">Удалить комментарий</button>
                @endif
            </div>
        @endforeach
    @endif
</div>
<div class="row" id="comment-form">
    <h4>Оставить комментарий</h4>
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <div class="btn-warning alert">{{$error}}</div>
        @endforeach
    @endif
    {!! Form::open() !!}
    <div class='form-group'>
        {!! Form::label('username', 'Ваше имя:') !!}
        {!! Form::text('username', null, ['class' => 'form-control']) !!}
    </div>
    <div class='form-group'>
        {!! Form::label('body', 'Текст') !!}
        {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
    </div>
    {!! Recaptcha::render() !!}
    {!! Form::submit('Отправить', ['class' => 'btn btn-default']) !!}
    {!! Form::close() !!}

</div>

@endsection
@section('javascript')
    @if (Auth::check())
    <script>
        $('.del-comment').click(function(){
            var comment_div = $(this).parent('.comment');
            var comment_id = comment_div.attr('id').split('omment')[1];
            $.post('/delete.comment.ajax', {id: comment_id}, function (resp) {
                if (resp == '1') {
                    comment_div.remove();
                } else {
                    alert(resp);
                }
            });
        });
    </script>
    @endif
@endsection