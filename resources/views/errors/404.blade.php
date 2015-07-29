@extends('main')

@section('content')

    {{-- Setting $page_title - it is not a mistake --}}
    @if ($page_title = 'Oops! 404 Page') @endif

    <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }
        .content {
            text-align: center;
            display: inline-block;
        }
        .title {
            font-size: 72px;
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato', sans-serif;
        }
    </style>
    <div class="container">
        <div class="content">
            <div class="title">404 Not Found</div>
        </div>
    </div>
@endsection