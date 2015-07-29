@extends('main')

{{-- Setting $page_title - it is not a mistake --}}
@if ($page_title = 'Регистрация') @endif

@section('content')

    <div class="register-box">
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
            <div class="btn-warning alert">{{$error}}</div>
            @endforeach
        @endif

        <div class="register-box-body">
            <p class="login-box-msg">Регистрация</p>
            <form action="/auth/register" method="post">{!! csrf_field() !!}
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Имя" name="name" value="{{ old('name') }}"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Пароль" name="password"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Пароль еще раз" name="password_confirmation"/>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Готово</button>
                    </div><!-- /.col -->
                </div>
            </form>

            <a href="/auth/login" class="text-center">У меня уже есть аккаунт</a>
        </div><!-- /.form-box -->
    </div><!-- /.register-box -->

@endsection