<?php 
    $dblSubTotal = 0;
?>
@extends('externallayout')

@section('title', 'Payment Invoice')
@section('content')
    <section class="content-header">
        <h1>
            Ticket Invoice
            <small>Control panel</small>

        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('/') }}"><i class="fa fa-wrench"></i> Dashboard</a></li>
           <li class="active">{{$ticketNumber}}</li>
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
                        Date: {{date('M j, Y',strtotime($datToday))}}
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
                <b>Control # {{$ticketNumber}}</b><br>
            </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
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
                        <?php $dblSubTotal += $value->dblPrice; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
        <?php 
            $dblTax = $dblSubTotal *  .03; 
            $dblTotal = $dblSubTotal + $dblTax;
        ?>
        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                <p class="lead">Payment Methods:</p>
                <!-- <img src="{{ URL::asset('assets/image/credit/visa.png') }}" alt="Visa">
                <img src="{{ URL::asset('assets/image/credit/mastercard.png') }}" alt="Mastercard"> -->
                <img src="{{ URL::asset('assets/image/credit/unionbank1.jpg') }}" alt="UnionBank">
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                Being a Visa card, the UnionBank Visa Debit Card can be used to make purchases at millions of local and global merchant outlets where Visa cards are accepted, as well as withdraw cash from more than 1.8 million ATMs in the Philippines and around the world.
                </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                <p class="lead">Amount Due</p>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>Php {{number_format($dblSubTotal,2)}}</td>
                        </tr>
                        <tr>
                            <th>Tax (.03%)</th>
                            <td>Php {{number_format($dblTax,2)}}</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>Php {{number_format($dblTotal,2)}}</td>
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
                <button type="button" class="btn btn-success pull-right submitPortalPayment"><i class="fa fa-credit-card"></i> Submit Payment
                </button>
                <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;" id="btnPrintInvoice">
                <i class="fa fa-print"></i> PDF
                </button>
            </div>
        </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>

    <div class="hide">
        <form method="POST" action="{{ URL::to('/payment/portal') }}" id="portalPayment">
            <input type="hidden" name="strTransactionControlNumber" value="{{$ticketNumber}}">
            <input type="hidden" name="dblPaymentAmount" value="{{$dblTotal}}">
            <input type="hidden" name="strDriverLicense" value="{{$driver->strDriverLicense}}">
        </form>
    </div>
@stop

@section('script')
    <script src="{{ URL::asset('assets/js/portalDriverInvoice.js') }}"></script>
@stop

