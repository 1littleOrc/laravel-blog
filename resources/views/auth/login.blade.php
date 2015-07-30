@extends('main')

{{-- Setting $page_title - it is not a mistake --}}
@if ($page_title = 'Вход') @endif

@section('content')
    <div class="row">
        <article class="post col08 offleft">
            <div class="login-box">
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="btn-warning alert">{{$error}}</div>
                    @endforeach
                @endif
                <div class="login-box-body">
                    <h1 class="login-box-msg">Пройдите аутентификацию</h1>

                    <form action="/auth/login" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group has-feedback">
                            <input type="email" class="form-control" placeholder="Email" name="email"
                                   value="{{ old('email') }}"/>

                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" placeholder="Пароль" name="password"
                                   id="password"/>

                        </div>
                        <div class="row" style="margin-left: 5px;">
                            <div class="col-xs-8">
                                <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox" name="remember"> Запомнить меня
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-default btn-block btn-flat">Войти</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                </div>
                <!-- /.login-box-body -->
            </div>
            <!-- /.login-box -->
        </article>
    </div>
@endsection