@extends('main')

@section('content')

    {{-- Setting $page_title - it is not a mistake --}}
    @if ($page_title = '404') @endif

    <style>
        .content404 {
            text-align: center;
            display: inline-block;
            width: 100%;
        }
        .title {
            font-size: 72px;
            line-height: 70px;
            margin: 0;
            padding: 0;
            width: 100%;
            font-weight: 100;
            background: rgba(0, 0, 0, 0.35);
            color: #101010;
            color: rgba(0,0,0,0.6);
            text-shadow: 2px 2px 3px rgba(255,255,255,0.1);
        }
    </style>

        <div class="content404">
            <div class="title"><br>404 <br>Не найдено<br><br></div>
            <br>Вернитесь <a href="/">на главную</a>.
        </div>

@endsection