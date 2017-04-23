@extends('index')

@section('title', 'Ticket Information')
@section('content')
    <section class="content-header">
        <h1>
            Ticket Information
            <small>Control panel</small>

        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('/dashboard') }}"><i class="fa fa-wrench"></i> Dashboard</a></li>
            <li><a href="{{ URL::to('/drivers') }}"></i> Drivers</a></li>
            <li><a href='{{ URL::to("/drivers/$driver->intDriverID") }}'></i>{{$driver->strDriverFirstname}} {{$driver->strDriverLastname}}</a></li>
           <li class="active">{{$ticketNumber}}</li>
        </ol>
    </section>
    <!-- Main content -->
    <div class="invoice col-xs-12 col-md-4">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    Control Number: {{$ticketNumber}}
                </h2>
            </div>
        </div>
        <div class="row invoice-info">
            <div class="col-sm-12 invoice-col">
                <p>Driver name: <b>{{$driver->strDriverFirstname}} {{$driver->strDriverLastname}}</b></p>
                <p>Date Caught: <b>{{date('M j, Y',strtotime($transHeader-> 
                                    TimestampCreated))}}</b></p>
                <p>Enforcer in-charge: <b>{{$transHeader->strEnforcerFirstname}} {{$transHeader->strEnforcerLastname}}</b></p>
                <p>Plate number: <b>{{$transHeader->strPlateNumber}}</b></p>
                <p>Vehicle type: <b>{{$transHeader->strVehicleDescription}}</b></p>
                <p>Registration Sticker: <b>{{$transHeader->strRegistrationSticker}}</b></p>
                <p>
                    <b style="font-size: 50px;"> 
                    @if($transHeader->blPaymentStatus)
                        <span style="color: green">
                            PAID 
                        </span>
                    @else
                        <span style="color: red">
                            UNPAID 
                        </span>
                    @endif
                    </b>
                </p>
            </div>
        </div>
        @if($transHeader->blPaymentStatus)
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    Payment Information
                </h2>
            </div>
        </div>
        <div class="row invoice-info">
            <div class="col-sm-12 invoice-col">
                <p>Confirmation Number: <b>{{$payment->strConfirmationNumber}}</b></p>
                <p>Payment method: 
                    <b>
                        @if($payment->blPaymentMethod)
                            Online
                        @else
                            Walk-in
                        @endif    
                    </b>
                </p>
                <p>Payment date: <b>{{date('M j, Y',strtotime($payment-> 
                                    datPaymentTransaction))}}</b></p>
            </div>
        </div>
        @endif
    </div>
    <div class="invoice col-xs-12 col-md-7">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    Violations
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Description</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($driverViolationsBreakdown as $value)
                        <tr>
                            <td>{{$value->strViolationCode}}</td>
                            <td>{{$value->strViolationDescription}}</td>
                            <td>Php {{number_format($value->dblPrice,2)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.content -->
    <div class="clearfix"></div>

@stop


