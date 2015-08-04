@extends('main')

@section('content')
    @include('articles.index-content')
@endsection

@section('head')
    @if ( $page == 1 )
        @if (isset($tag))

            <meta property="og:type" content="website"/>
            <meta property="og:url" content="{{ Request::url() }}"/>
            <meta property="og:title" content="phpdreamer's blog: {{ $tag }}"/>
            <meta property="og:image" content="{{ $tag_image }}"/>
            <meta property="og:description" content="Все о {{ $tag }}"/>
        @else

            <meta property="og:type" content="website"/>
            <meta property="og:url" content="{{ Request::url() }}"/>
            <meta property="og:title" content="phpdreamer's blog"/>
            <meta property="og:image" content="{{ asset('images/3100053.jpg') }}"/>
            <meta property="og:description"
                  content="Блог веб разработчика: PHP Python Linux Bash JavaScript HTML MySQL"/>
        @endif
    @endif
@endsection