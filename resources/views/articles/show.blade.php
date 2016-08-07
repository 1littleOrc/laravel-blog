@extends('main')

@section('content')
    <article itemscope itemtype="http://schema.org/BlogPosting">
        <h1 style="font-size: 20px;" itemprop="name headline">{{ $article->title }}</h1>

        <div class="date">{{ $article->getDate() }}</div>
        <div itemprop="text">{!! $article->content !!}</div>
        <br>

        <div class="stars">
            @include('articles.rating', [
                'id' => $article->id,
                'value' => $article->rating,
                'itemReviewed' => $article->title,
                'ratingCount' => $article->votes()->count()
            ])
        </div>
        <meta itemprop="commentCount" content="{{ $article->comments()->count() }}"/>
        <meta itemprop="datePublished" content="{{ $article->created_at }}"/>
        <meta itemprop="image" content="{{ $article->getImageUrl() }}"/>


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
                    <div class="comment" id="comment{{ $comment->id }}" itemscope="itemscope"
                         itemtype="http://schema.org/Comment">
                        <div class="comment-author">
                            <span itemprop="creator">{{ $comment->username }}</span>:
                            <div class="comment-date" itemprop="datePublished">{{ $comment->created_at }}</div>
                        </div>
                        <div class="comment-body" itemprop="text">
                            {!! nl2br(e($comment->body))!!}
                        </div>
                        @if (Auth::check())
                            <button class="btn btn-default del-comment">Удалить комментарий</button>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </article>

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <ins class="adsbygoogle"
         style="display:inline-block;width:728px;height:90px"
         data-ad-client="ca-pub-7438604017777834"
         data-ad-slot="2050350497"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>


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
            $('.del-comment').click(function () {
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

@section('head')

    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{ Request::url() }}"/>
    <meta property="og:title" content="{{ $article->title }}"/>
    <meta property="og:image" content="{{ $article->getImageUrl() }}"/>
    <meta property="og:description" content="{{ str_replace("\n", ' ', strip_tags($article->small)) }}"/>

@endsection