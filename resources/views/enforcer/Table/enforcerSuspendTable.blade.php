<div class="col-md-12" id="enforcerTable">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Enforcer</h3>
        </div>
        <div class="box-body">
            <table id="dtblEnforcer" class="table table-bordered table-hover">
                <thead>
                    <tr>  
                        <th class="hide"></th>
                        <th class="hide"></th>
                        <th class="hide"></th>
                        <th class="hide"></th>
                        <th>Name</th>
                        <th>Last signed-in</th>
                        <th>Date suspended</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($enforcers as $enforcer)
                        <tr>
                            <td class="hide classEnforcerPrimaryKey">{{$enforcer->intEnforcerID}}</td>
                            <td class="hide classFirstname">{{$enforcer->strEnforcerFirstname}}</td>
                            <td class="hide classLastname">{{$enforcer->strEnforcerLastname}}</td>
                            <td class="hide classUserID">{{$enforcer->intUserID}}</td>
                            <td style="cursor: pointer" class="clickable-row name" data-href="enforcer/show/{{$enforcer->intEnforcerID}}">
                                {{$enforcer->strEnforcerFirstname}} {{$enforcer->strEnforcerLastname}}
                            </td>
                            <td class="lastSignedIn">
                                <?php
                                $dateLastSignedin = ($enforcer->datLastSignedin == "0000-00-00 00:00:00") ? "Never logged in" :
                                    date('M j, Y',strtotime($enforcer->datLastSignedin));
                                ?>   
                                {{$dateLastSignedin}}
                            </td>
                            <td class="dateDeleted">
                                {{date('M j, Y',strtotime($enforcer->TimestampDeleted))}}
                            </td>
                            <td width="100px">
                                
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-default btnRestoreEnforcer" data-toggle="tooltip" title="Restore enforcer">
                                            <i class="fa fa-fw fa-refresh"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="hide"></th>
                        <th class="hide"></th>
                        <th class="hide"></th>
                        <th class="hide"></th>
                        <th>Name</th>
                        <th>Last signed-in</th>
                        <th>Date suspended</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div id="loadingEnforcer">
            <i id="loadingEnforcerDesign"></i>
        </div>
    </div>
</div>
<script src="{{ URL::asset('assets/js/enforcerIndex.js') }}"></script>