@extends('layoutlogin')

@section('title', 'Drivers Portal Login')

@section('content')
<div class="col-xs-12 col-md-offset-4 col-md-4">
    <center>
    <div>
        <a href=""><img src="assets/image/icons/Hooleh.png" alt="Hooleh"></a>
        <h3 style="color:white"><b>Drivers</b> Portal</h3>
    </div>
    <!-- /.login-logo -->
    <div>
        <form role="form" method="POST" action="{{ url('/portal/auth/login') }}">
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
                        <input type="text" class="form-control" name="driverlicense" placeholder="Driver's License No.">
                    </div>
                </div>      
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-offset-1 col-md-10">
                    <div class="form-group has-feedback">
                        <input id ="datepicker" type="text" class="form-control" name = "birthday" placeholder="Birthday" data-date-format="yyyy-mm-dd">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-offset-1 col-md-10">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">LOGIN</button>
                </div>
            </div>
        </form>
    </div>
    </center>
</div>
<!-- /.login-box -->

@stop



@section('script')
    <script type="text/javascript">
            $(function () {
                $('#datepicker').datepicker();
            });
        </script>
@endsection