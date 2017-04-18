@extends('index')

@section('title', 'Enforcer Profile')
@section('content')
    <section class="content-header">
        <h1>
            Enforcer Profile
            <small>Control panel</small>

        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('/dashboard') }}"><i class="fa fa-wrench"></i> Dashboard</a></li>
            <li><a href="{{ URL::to('/enforcer') }}"></i> Enforcer</a></li>
            <li class="active">{{$enforcer->strEnforcerFirstname}} {{$enforcer->strEnforcerLastname}}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="col-md-offset-2 col-md-8 col-sm-offset-2">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-aqua-active">
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ URL::asset('assets/image/avatar/officerAvatar.jpg') }}" alt="User Avatar">
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">{{$enforcer->strEnforcerFirstname}} {{$enforcer->strEnforcerLastname}}</h3>
                    <h5 class="widget-user-desc">{{$enforcer->strEnforcerIdNumber}}</h5>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li>
                            <a href="#">
                                <p class="credentials">Account Information</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">Status 
                                <span class="pull-right badge bg-green">
                                    @if(@blEnforcerDelete == 0)
                                        Active
                                    @elseif(@blEnforcerDelete == 1)
                                        Suspended
                                    @else
                                        Deleted
                                    @endif
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Last login <span class="pull-right">
                                <?php
                                $dateLastSignedin = ($enforcer->datLastSignedin == "0000-00-00 00:00:00") ? "Never logged in" :
                                    date('M j, Y',strtotime($enforcer->datLastSignedin));
                                ?>   
                                {{$dateLastSignedin}}
                            </span></a>
                        </li>
                        <li>
                            <a href="#">Transactions<span class="pull-right badge bg-aqua">{{$transactionHeader}}</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@stop
