<div class="col-md-12" id="violationTable">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Violation</h3>
        </div>
        <div class="box-body">
            <table id="dtblViolation" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="hide"></th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Fine</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($violations as $violation)
                        <tr>
                            <td class="hide classViolationPrimaryKey">{{$violation->intViolationID}}</td>
                            <td class="classCode clickable-row" style="cursor: pointer" data-href="violation/show/{{$violation->intViolationID}}">
                                {{$violation->strViolationCode}}
                            </td>
                            <td class="classDescription clickable-row" style="cursor: pointer" data-href="violation/show/{{$violation->intViolationID}}">
                                {{$violation->strViolationDescription}}
                            </td>
                            <td class="classFine">
                                P {{number_format($violation->dblPrice,2)}}
                            </td>
                            <td>
                                <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-default btnUpdateViolation" data-toggle="tooltip" title="Update">
                                        <i class="fa fa-fw fa-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#" class="btnDeleteViolation">Delete Violation</a></li>
                                </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="hide"></th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Fine</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div id="loadingViolation">
            <i id="loadingViolationDesign"></i>
        </div>
    </div>
</div>
<script src="{{ URL::asset('assets/js/violationIndex.js') }}"></script>