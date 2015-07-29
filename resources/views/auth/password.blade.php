@extends('main')

{{-- Setting $page_title - it is not a mistake --}}
@if ($page_title = 'Восстановление пароля') @endif

@section('content')
    <div class="login-box">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <div class="alert-danger alert">{{$error}}</div>
            @endforeach
        @endif
        <div class="login-box-body">

            <form action="{{ url('/password/email') }}" method="post">
                {!! csrf_field() !!}
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" name="email"
                           value="{{ old('email') }}"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Восстановление на почту</button>
                </div>
            </form>


        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->

@endsection