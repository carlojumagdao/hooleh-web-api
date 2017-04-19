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
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-8" id="driverViolationTable">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List of {{$driver->strDriverFirstname}} {{$driver->strDriverLastname}}'s violations</h3>
                </div>
                <div class="box-body">
                    <table id="dtblDriverViolations" class="table table-bordered table-hover">
                        <thead>
                            <tr> 
                                <th>Control #</th>
                                <th>Total Fine</th>
                                <th>Date Caught</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($driverViolations as $driverViolation)
                                <tr>
                                    <td>{{$driverViolation->strControlNumber}}</td> 
                                    <td>Php {{number_format($driverViolation->totalFine,2)}}</td>
                                    <td>{{date('M j, Y',strtotime($driverViolation-> 
                                    TimestampCreated))}}</td>
                                    <td>
                                        @if($driverViolation->blPaymentStatus)
                                            <span class="pull-right badge bg-green">
                                                Paid
                                            </span>
                                        @else
                                            <span class="pull-right badge bg-red">
                                                Unpaid
                                            </span>
                                        @endif
                                    </td>   
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Control #</th>
                                <th>Total Fine</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop
