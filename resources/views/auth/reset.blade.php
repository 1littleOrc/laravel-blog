@extends('main')

{{-- Setting $page_title - it is not a mistake --}}
@if ($page_title = 'Новый пароль') @endif

@section('content')
    <div class="login-box">
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <div class="btn-warning alert">{{$error}}</div>
            @endforeach
        @endif
        <div class="login-box-body">

            <form action="/password/reset" method="post">
                {!! csrf_field() !!}
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Пароль" name="password" id="password"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Пароль еще раз" name="password_confirmation"/>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Сохранить новый</button>
                </div>

            </form>

        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

@endsection