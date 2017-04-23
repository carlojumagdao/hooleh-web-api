@extends('index')

@section('title', 'Drivers')
@section('content')
    <section class="content-header">
        <h1>
            Drivers
            <small>Control panel</small>

        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-wrench"></i> Dashboard</a></li>
            <li class="active">Drivers</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="loading">Loading&#8230;</div>
            <div class="col-md-12" id="enforcerTable">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Drivers</h3>
                    </div>
                    <div class="box-body">
                        <table id="dtblDriver" class="table table-bordered table-hover">
                            <thead>
                                <tr>  
                                    <th class="hide"></th>
                                    <th class="hide"></th>
                                    <th class="hide"></th>
                                    <th>License No.</th>
                                    <th>Name</th>
                                    <th>Last signed-in</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($drivers as $driver)
                                    <tr>
                                        <td class="hide classdriverPrimaryKey">{{$driver->intDriverID}}</td>
                                        <td class="hide classFirstname">{{$driver->strDriverFirstname}}</td>
                                        <td class="hide classLastname">{{$driver->strDriverLastname}}</td>   
                                        <td style="cursor: pointer" class="clickable-row name" data-href="drivers/show/{{$driver->intDriverID}}">{{$driver->strDriverLicense}}</td> 
                                        <td >
                                            {{$driver->strDriverFirstname}} {{$driver->strDriverLastname}}
                                        </td>
                                        <td class="lastSignedIn">
                                            <?php
                                            $dateLastSignedin = ($driver->datLastSignedin == "0000-00-00 00:00:00") ? "Never logged in" :
                                                date('M j, Y',strtotime($driver->datLastSignedin));
                                            ?>   
                                            {{$dateLastSignedin}}
                                        </td>
                                        <td width="80px">
                                            <button type="button" class="btn btn-sm btn-default btnRenameEnforcer" data-toggle="tooltip" title="Rename">
                                                <i class="fa fa-fw fa-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="hide"></th>
                                    <th class="hide"></th>
                                    <th class="hide"></th>
                                    <th>License No.</th>
                                    <th>Name</th>
                                    <th>Last signed-in</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div id="loadingDriver">
                        <i id="loadingDriverDesign"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop


@section('script')
    <script src="{{ URL::asset('assets/js/driverIndex.js') }}"></script>
@stop