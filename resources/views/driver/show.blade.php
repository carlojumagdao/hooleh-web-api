@extends('index')

@section('title', 'Driver Profile')
@section('content')
    <section class="content-header">
        <h1>
            Driver Profile
            <small>Control panel</small>

        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('/dashboard') }}"><i class="fa fa-wrench"></i> Dashboard</a></li>
            <li><a href="{{ URL::to('/drivers') }}"></i> Drivers</a></li>
            <li class="active">{{$driver->strDriverFirstname}} {{$driver->strDriverLastname}}</li>
        </ol>
    </section>

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

        <div class="col-md-8" id="driverTicketsTable">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">LIST OF TICKETS</h3>
                </div>
                <div class="box-body">
                    <table id="dtblDriverViolations" class="table table-bordered table-hover">
                        <thead>
                            <tr> 
                                <th>Control #</th>
                                <th>Fine</th>
                                <th>Date Caught</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($driverViolations as $driverViolation)
                                <tr>
                                    <td style="cursor: pointer" class="clickable-row name" data-href='{{ URL::to("drivers/$driver->intDriverID/tickets/$driverViolation->strControlNumber")}}'>
                                    {{$driverViolation->strControlNumber}}</td> 
                                    <td>Php {{number_format($driverViolation->totalFine,2)}}</td>
                                    <td>{{date('M j, Y',strtotime($driverViolation-> 
                                    TimestampCreated))}}</td>
                                    <td width="50px">
                                        @if($driverViolation->blPaymentStatus)
                                            <span class="badge bg-green">
                                                Paid
                                            </span>
                                        @else
                                            <span class="badge bg-red">
                                                Unpaid
                                            </span>
                                        @endif
                                    </td>   
                                    <td width="50px">
                                        @if(!$driverViolation->blPaymentStatus)
                                        <a href='{{ URL::to("drivers/$driver->intDriverID/tickets/payment/$driverViolation->strControlNumber")}}' type="button" class="btn btn-sm btn-default">
                                                Pay Now
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Control #</th>
                                <th>Fine</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop

@section('script')
    <script src="{{ URL::asset('assets/js/driverShow.js') }}"></script>
@stop
