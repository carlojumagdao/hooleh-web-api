@extends('layoutlogin')

@section('title', 'Administrator Login')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href=""><img src="assets/image/icons/Hooleh.png" class="center-align" alt="Hooleh"></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <h3 class="login-box-msg"><b>Administrator</b> Login</h3>

        <form role="form" method="POST" action="{{ url('/auth/login') }}">
            {{ csrf_field() }}
            <div class="login-box-msg">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> Something went wrong!</h4>
                        {!! implode('', $errors->all(
                            '<li>:message</li>'
                        )) !!}
                    </div>
                @endif
                @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!</h4>
                        {{ Session::get('message') }}
                    </div>
                @endif
            </div>
            <div class="form-group has-feedback">
                <input id = "userame" type="email" class="form-control" name = "username" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span
            </div>       
            <div class="form-group has-feedback">
                <input id ="password" type="password" class="form-control" name = "password" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

@stop




@section('script')

    <script src="{{ URL::asset('assets/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
            });
        });
    </script>
@endsection