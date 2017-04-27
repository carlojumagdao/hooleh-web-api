@extends('externallayout')

@section('title', 'Driver Portal')
@section('content')
    <div class="container">
        <section class="content-header">
            <h1>
                Driver Portal
                <small>Control panel</small>

            </h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-wrench"></i> Dashboard</li>
            </ol>
        </section>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="col-md-4">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-aqua-active">
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ URL::asset('assets/image/avatar/driverAvatar.png') }}" alt="User Avatar">
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">{{$driver->strDriverFirstname}} {{$driver->strDriverLastname}}</h3>
                    <h5 class="widget-user-desc">{{$driver->strDriverLicense}}</h5>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li>
                            <a href="#">
                                <p class="credentials">Account Information</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">License expiration date <span class="pull-right">
                                {{date('M j, Y',strtotime($driver->datLicenseExpiration))}}
                            </a>
                        </li>   
                        <li>
                            <a href="#">License type <span class="pull-right">
                                {{$LicenseType->strLicenseType}}
                            </span></a>
                        </li>
                        <li>
                            <a href="#">Total unpaid fine <span class="pull-right">
                                <b>Php {{number_format($driverTotalFine,2)}}</b> 
                            </span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        @foreach($driverViolations as $driverViolation)
        <div class="col-md-4">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header">
                    @if($driverViolation->blPaymentStatus)
                        <div class="widget-user-image">
                            <img class="img-circle" src="{{ URL::asset('assets/image/icons/successIcon.png') }}" alt="Paid Ticket">
                        </div>
                    @else
                        <div class="widget-user-image">
                            <img class="img-circle" src="{{ URL::asset('assets/image/icons/errorIcon.png') }}" alt="Paid Ticket">
                        </div>
                    @endif
                    <h3 class="widget-user-username">{{$driverViolation->strControlNumber}}</h3>
                    <h5 class="widget-user-desc">{{date('M j, Y',strtotime($driverViolation-> 
                                    datCaught))}}</h5>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li>
                            <a href="#">
                                <p class="credentials">Ticket Information</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">Total Fine <span class="pull-right">
                                Php {{number_format($driverViolation->totalFine,2)}}
                            </a>
                        </li>   
                        <li>
                            <a href="#">Enforcer in-charge <span class="pull-right">
                                {{$driverViolation->strEnforcerFirstname}}
                                 {{$driverViolation->strEnforcerLastname}}
                            </span></a>
                        </li>
                        <li>
                            <a href="#">Status 
                                <span class="pull-right">
                                    <b>
                                    @if($driverViolation->blPaymentStatus)
                                        <span class="badge bg-green">
                                            Paid
                                        </span>
                                    @else
                                        <span class="badge bg-red">
                                            Unpaid
                                        </span>
                                    @endif
                                    </b>
                                </span>
                            </a>
                        </li>
                        <li>
                            @if(!$driverViolation->blPaymentStatus)
                                <a href='{{ URL::to("portal/drivers/$driver->intDriverID/tickets/invoice/$driverViolation->strControlNumber")}}'>
                                    <center>    
                                        <button class="btn btn-primary btn-block">PAY NOW</button>
                                    </center>
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </section>
@stop


@section('script')
    
@stop