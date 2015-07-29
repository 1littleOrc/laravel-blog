@extends('main')

{{-- Setting $page_title - it is not a mistake --}}
@if ($page_title = 'Вход') @endif

@section('content')
    <div class="login-box">
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <div class="btn-warning alert">{{$error}}</div>
            @endforeach
        @endif
        <div class="login-box-body">
            <p class="login-box-msg">Пройдите аутентификацию</p>
            <form action="/auth/login" method="post">
                {!! csrf_field() !!}
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Пароль" name="password" id="password"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row" style="margin-left: 5px;">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> Запомнить меня
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Войти</button>
                    </div><!-- /.col -->
                </div>
            </form>

            <a href="{{ url('password/email/') }}">Я забыл пароль</a><br>
            <a href="{{ url('auth/register/') }}" class="text-center">Регистрация</a>

        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <style>
        .main-sidebar, .sidebar-toggle{display: none}
        .content-wrapper, .right-side, .main-footer{margin-left: 0}
    </style>


@endsection