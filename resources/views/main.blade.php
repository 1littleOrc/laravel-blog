<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $page_title or "phpdreamer's blog" }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'>
    <link rel="stylesheet" href="{{ elixir("css/all.css") }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset("/images/my.ico") }}" type="image/x-icon" />
    @yield('head')

</head>
<body itemscope itemtype="http://schema.org/Blog">
<div class="container">
    <header>

        <a href="/"><img id="logo-img" src="{{ asset("/images/logo.png") }}" alt="phpdreamer's blog">
            <img src="{{ asset("/images/3100053.jpg") }}"
                 itemprop="image"
                 alt="phpdreamer" style="float: right;border-radius: 50% 0;">
        </a>

    </header>
    <div class="zerogrid">
        <section class="row">
            <div class="sidebar col12 offall">

                <div class="heading">Теги</div>
                <div class="content tags" itemprop="keywords">
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
                                | <a href="{{ URL::to('/auth/logout') }}">Выход</a>

                        @else
                                <a href="{{ URL::to('/auth/login') }}" title="Панель управления"
                                   style="float: right;"><img title="Панель управления"
                                                              src="{{ asset("/images/login.png") }}"
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
@if (Agent::isMobile())
<script src="{{ elixir("js/main.mobile.js") }}"></script>
@else
<script src="{{ elixir("js/main.js") }}"></script>
@endif

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<link rel="stylesheet" href="{{ asset("/css/highlight/idea.css") }}" property="">
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
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-12106207-9', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>