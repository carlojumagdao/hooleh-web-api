@extends('index')

@section('title', 'Enforcers')
@section('content')
    <section class="content-header">
        <h1>
            Enforcer
            <small>Control panel</small>

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-wrench"></i> Dashboard</a></li>
            <li class="active">Enforcer</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Filters</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <select class="form-control selFilter">
                                <option value="0">Active users</option>
                                <option value="1">Suspended users</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary btn-block addEnforcer" data-toggle="modal" data-target="#modalAddEnforcer" title="AddEnforcer">Add enforcer</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="loading">Loading&#8230;</div>
            <div class="col-md-9" id="enforcerTable">
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
                                        <td width="150px">
                                            
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-default btnResetPassword" data-toggle="tooltip" title="Reset Password">
                                                        <i class="fa fa-fw fa-unlock"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-default btnRenameEnforcer" data-toggle="tooltip" title="Rename">
                                                    <i class="fa fa-fw fa-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#" class="btnSuspendEnforcer">Suspend Enforcer</a></li>
                                                </ul>
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
        </div>
        <!-- MODAL ADD ENFORCER -->
        <div class="modal fade" id="modalAddEnforcer" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Create new enforcer</h4>
                    </div>

                    <form role="form" data-toggle="validator" id="form">
                        <div class="modal-body">
                            <div class="box-body">
                                <p class="help-block col-sm-12" id="formErrorMessage" style="color:red;">
                                    Something went wrong, please check your inputs.
                                </p>
                                <div class="form-group  col-sm-6">
                                    <input type="text" class="form-control" id="inputFirstname" placeholder="First name" size="35" required>
                                </div>
                                <div class="form-group  col-sm-6">
                                    <input type="text" class="form-control" id="inputLastname" placeholder="Last name" size="35" required>
                                </div>
                                <p class="help-block"></p>
                                <div class="form-group  col-sm-6">
                                    <input type="email" class="form-control" id="inputEnforcerID" placeholder="Email" size="35" required>
                                </div>

                                <p class="help-block col-sm-12" id="setPasswordBlock">Temporary password will be assigned - 
                                    <a id="setPassword" style="cursor: pointer">
                                        Set Password
                                    </a>
                                </p>
                                <div class="form-group col-sm-12"></div>
                                <div class="passwordCredential">
                                    <div class="form-group col-sm-6">
                                        <input type="password" class="form-control" id="inputPassword" data-minlength="6" placeholder="Password" size="35" required>
                                        <div class="help-block">Minimum of 6 characters</div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <input type="password" class="form-control" id="inputReEnterPassword" data-minlength="6" placeholder="Confirm password" size="35" data-match="#inputPassword" data-match-error="Whoops, these don't match" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <p class="help-block col-sm-12">
                                        <a id="autoGeneratePassword" style="cursor: pointer">
                                            Auto-generate password
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                            <span class="form-group">
                                <button type="submit" id="btnCreateEnforcer" class="btn btn-primary">Create</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- MODAL ADD ENFORCER-->

        <!-- MODAL SUCCESSFUL CREATION -->
        <div class="modal fade" id="modalSuccessfulCreation" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Create a new enforcer</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            <img class="img-responsive" src="assets/image/icons/successIcon.png" alt="Success Icon" width="20px" align="left">
                            &nbsp; A new enforcer named <span id="successFirstname"></span> <span id="successLastname"></span> has been created.
                        </p>
                        <div class="successMessage">
                            <p>Sign in to Hooleh app using the following credential:</p>
                            <p>Email:</p>
                            <p id="successUsername" class="credentials"></p>
                            <p>Password:</p>
                            <p id="successPassword" class="credentials"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="btnCreateAnotherEnforcer">CREATE ANOTHER USER</button>
                        <button type="button" id="btnPrint" class="btn btn-default">PRINT</button>
                        <button type="button" id="btnSendEmail" class="btn btn-primary">SEND EMAIL</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL SUCCESSFUL CREATION -->

        <!-- MODAL RENAME ENFORCER -->
        <div class="modal fade" id="modalRenameEnforcer" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Rename enforcer</h4>
                    </div>

                    <form role="form" data-toggle="validator" id="formRename">
                        <div class="modal-body">
                            <div class="box-body">
                                <p>Before renaming this user, ask the enforcer to sign out of his or her account. After you rename this enforcer:</p>
                                <ul>
                                    <li>The rename operation can take up to 5 minutes.</li>
                                    <li>The new name might not be available for up to 5 minutes.</li>
                                </ul>
                                <p class="help-block col-sm-12" id="formErrorMessageRename" style="color:red;">
                                    Something went wrong, please check your inputs.
                                </p>
                                <div class="form-group  col-sm-6">
                                    <input type="text" class="form-control" id="inputFirstnameRename" placeholder="First name" size="35" required>
                                </div>
                                <div class="form-group  col-sm-6">
                                    <input type="text" class="form-control" id="inputLastnameRename" placeholder="Last name" size="35" required>
                                </div>
                                <p class="help-block"></p>
                                <div class="form-group  col-sm-6">
                                    <input type="hidden" class="form-control" id="inputEnforcerPrimaryKey">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                            <span class="form-group">
                                <button type="submit" id="btnRenameEnforcerSubmit" class="btn btn-primary">Rename enforcer</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- MODAL RENAME ENFORCER-->

        <!-- MODAL SUCCESSFUL RENAME -->
        <div class="modal fade" id="modalSuccessfulRename" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Rename enforcer</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            <img class="img-responsive" src="assets/image/icons/successIcon.png" alt="Success Icon" width="20px" align="left">
                            &nbsp; Rename successful.
                        </p>
                        <div class="successMessage">
                            <p>The updated name is: <span id="updatedName" class="credentials"></span></p>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" id="btnPrint" class="btn btn-primary">PRINT</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL SUCCESSFUL RENAME -->

        <!-- MODAL RESET PASSWORD -->
        <div class="modal fade" id="modalResetPassword" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Reset password</h4>
                    </div>

                    <form role="form" data-toggle="validator" id="formResetPassword">
                        <div class="modal-body">
                            <div class="box-body">
                                <div class="form-group col-sm-12"></div>
                                <div class="">
                                    <div class="form-group col-sm-6">
                                        <input type="password" class="form-control" id="inputPasswordReset" data-minlength="6" placeholder="Password" size="35" required>
                                        <div class="help-block">Minimum of 6 characters</div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <input type="password" class="form-control" id="inputReEnterPasswordReset" data-minlength="6" placeholder="Confirm password" size="35" data-match="#inputPasswordReset" data-match-error="Whoops, these don't match" required>
                                        <div class="help-block with-errors"></div>
                                        <div class="form-group  col-sm-6">
                                            <input type="hidden" class="form-control" id="inputUserID">
                                        </div>
                                    </div>
                                    <p class="help-block col-sm-12">
                                        <a id="autoGeneratePasswordReset" style="cursor: pointer">
                                            Auto-generate password
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                            <span class="form-group">
                                <button type="submit" id="btnResetPasswordSubmit" class="btn btn-primary">Reset password</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- MODAL RESET PASSWORD -->

        <!-- MODAL SUCCESSFUL RESET -->
        <div class="modal fade" id="modalResetPasswordSuccess" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Reset password</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            <img class="img-responsive" src="assets/image/icons/successIcon.png" alt="Success Icon" width="20px" align="left">
                            &nbsp; Reset password successful.
                        </p>
                        <div class="successMessage">
                            <p>The new password is: <span id="updatedPassword" class="credentials"></span></p>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" id="btnPrint" class="btn btn-primary">PRINT</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL SUCCESSFUL RESET -->

        <!-- MODAL SUCCESSFUL SUSPEND ENFORCER -->
        <div class="modal fade" id="modalSuspendEnforcerSuccess" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Suspend enforcer</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            <img class="img-responsive" src="assets/image/icons/successIcon.png" alt="Success Icon" width="20px" align="left">
                            &nbsp; Suspend enforcer success.
                        </p>
                        <div class="successMessage">
                            <p>Enforcer <span id="suspendedEnforcer" class="credentials"></span> is now suspended</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" id="btnPrint" class="btn btn-primary">PRINT</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL SUCCESSFUL SUSPEND ENFORCER -->

        <!-- MODAL SUCCESSFUL RESTORE ENFORCER -->
        <div class="modal fade" id="modalRestoredEnforcerSuccess" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Restore enforcer</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            <img class="img-responsive" src="assets/image/icons/successIcon.png" alt="Success Icon" width="20px" align="left">
                            &nbsp; Restore enforcer success.
                        </p>
                        <div class="successMessage">
                            <p>Enforcer <span id="restoredEnforcer" class="credentials"></span> is now restored</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" id="btnPrint" class="btn btn-primary">PRINT</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL SUCCESSFUL RESTORE    ENFORCER -->

    </section>
@stop


@section('script')
    <script src="{{ URL::asset('assets/js/enforcerIndex.js') }}"></script>
@stop