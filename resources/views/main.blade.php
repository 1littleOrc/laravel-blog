<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $page_title or "phpdreamer's blog" }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'>
    <link rel="stylesheet" href="{{ asset("/css/style.min.css") }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/images/my.ico" type="image/x-icon" />
</head>
<body>
<div class="container">
    <header>

        <a href="/"><img id="logo-img" src="/images/logo.png" alt="phpdreamer's blog">
            <img src="https://avatars1.githubusercontent.com/u/3100053?v=3&s=150"
                 alt="phpdreamer avatar" style="float: right;border-radius: 50% 0;">
        </a>

    </header>
    <div class="zerogrid">
        <section class="row">
            <div class="sidebar col12 offall">

                <div class="heading">Теги</div>
                <div class="content tags">
                    @foreach(config('sitemap.tags') as $tag => $label)
                        {!! link_to_route('tag', $label, $tag) !!}
                    @endforeach
                </div>

            </div>
            <div class="sidebar col04 offall" style="float: right">

                <div class="heading">Контакты</div>
                <div class="content">
                    <ul class="list">
                        <li>
                            <a href="http://phpdreamer.ru/">Визитка</a>

                        @if (Auth::check())

                                | {!! link_to_route('articles.create', 'Новый пост') !!}
                                | <a href="/auth/logout">Выход</a>

                        @else
                                <a href="/auth/login" title="Панель управления"
                                   style="float: right;"><img title="Панель управления"
                                                              src="/images/login.png"
                                                              alt="Вход в панель управления"
                                                              style="opacity:0.6;filter:alpha(opacity=60);"></a>

                        @endif
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <section>
            <div class="row block">
                <div class="main-content col16">
                    @yield('content')
                </div>
            </div>
        </section>
    </div>
</div>

<script src="{{ asset("/js/highlight.pack.js") }}"></script>
<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<link rel="stylesheet" href="{{ asset("/css/highlight/idea.css") }}">
<script>
    $(document).ready(function () {
        $('pre code').each(function (i, block) {
            hljs.highlightBlock(block);
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });</script>
@yield('javascript')

<div id="copyright">
    <p>Copyright © 2015 - phpdreamer.ru</p>
</div>
</body>
</html>