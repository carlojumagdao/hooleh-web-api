@extends('layoutlogin')

@section('title', 'Administrator Login')

@section('content')
<div class="col-xs-12 col-md-offset-4 col-md-4">
    <center>
    <div>
        <a href=""><img src="{{ URL::asset('assets/image/icons/Hooleh.png') }}" alt="Hooleh"></a>
        <h3 style="color:white"><b>Administrator</b> Login</h3>
    </div>
    <!-- /.login-logo -->
    <div>
        <form role="form" method="POST" action="{{ url('/auth/login') }}">
            {{ csrf_field() }}
            <div>
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
            <div class="row">
                <div class="col-xs-12 col-md-offset-1 col-md-10">
                    <div class="form-group has-feedback">
                        <input id = "userame" type="email" class="form-control" name = "username" placeholder="EMAIL">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                </div>      
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-offset-1 col-md-10">
                    <div class="form-group has-feedback">
                        <input id ="password" type="password" class="form-control" name = "password" placeholder="PASSWORD">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="checkbox icheck">
                    <label style="color:white">
                        <input type="checkbox" name="remember"> REMEMBER ME
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-offset-1 col-md-10">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">LOGIN</button>
                </div>
            </div>
        </form>

        <a class="btn btn-link" style="color:white" href="{{ url('/password/reset') }}"><b>FORGOT YOUR PASSWORD?</b></a>

    </div>
    </center>
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