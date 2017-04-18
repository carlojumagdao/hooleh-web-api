@extends('index')

@section('title', 'Violation Info')

@section('content')
    <section class="content-header">
        <h1>
            Violation Info
            <small>Control panel</small>

        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('/dashboard') }}"><i class="fa fa-wrench"></i> Dashboard</a></li>
            <li><a href="{{ URL::to('/enforcer') }}"></i> Violation</a></li>
            <li class="active">{{$violation->strViolationCode}}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="col-md-offset-2 col-md-8 col-sm-offset-2">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-aqua-active">
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ URL::asset('assets/image/icons/violationIcon.png') }}" alt="violation">
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">Violation Code: {{$violation->strViolationCode}}</h3>
                    <h5 class="widget-user-desc">{{$violation->strViolationDescription}}</h5>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li>
                            <a href="#">
                                <p class="credentials">Violation Information</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">Status 
                                <span class="pull-right badge bg-green">
                                    @if(@blViolationDelete == 0)
                                        Active
                                    @elseif(@blViolationDelete == 1)
                                        Deleted
                                    @else
                                        Deleted
                                    @endif
                                </span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="#">Violation Fine<span class="pull-right badge bg-aqua">P {{number_format($violationFee->dblPrice,2)}}</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@stop
