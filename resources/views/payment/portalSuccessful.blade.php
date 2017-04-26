
<?php 
    $dblSubTotal = 0;
?>
@extends('externallayout')

@section('title', 'Payment Invoice')
@section('content')
    <section class="content-header">
        <h1>
            Ticket Payment Receipt Invoice
            <small>Control panel</small>

        </h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-wrench"></i> Dashboard</a></li>
           <li class="active">{{$strConfirmationNumber}}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> Department of Public Order and Safety - Quezon City
                    <small class="pull-right">
                        
                    </small>
                </h2>
            </div>
        <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                From:
                <address>
                    <strong>DPOS, Quezon City.</strong><br>
                    Hall Compound, Elliptical Road, Diliman, <br>
                    Barangay Central, Quezon City, 1100 <br>
                    Phone: (02) 988 4242<br>
                    Email: info@qcdpos.gov.ph
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                To:
                <address>
                    <strong>{{$driver->strDriverFirstname}} {{$driver->strDriverLastname}}</strong><br>
                    {{$driver->strDriverLicense}}<br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Confirmation Number: {{$strConfirmationNumber}}</b>
            </div>

            
        <!-- /.col -->
        </div>
        <!-- /.row -->

            <!-- /.col -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                <p class="lead">Amount Due</p>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Total:</th>
                            <td>{{number_format($totalAmount,2)}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <a href='{{ URL::to("/drivers/$driverID") }}' type="button" class="btn btn-primary">
                    Back to Driver's Page
                </a>
                <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;" id="btnPrintInvoice">
                <i class="fa fa-print"></i> PDF
                </button>

            </div>
        </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>

@stop

@section('script')
    <script src="{{ URL::asset('assets/js/portalDriverInvoice.js') }}"></script>
@stop
