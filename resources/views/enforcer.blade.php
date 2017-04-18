@extends('index')

@section('title', 'Enforcers')

@section('content')
    <section class="content-header">
        <h1>
            Maintenance
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-wrench"></i> Maintenance</a></li>
            <li class="active">Enforcer</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Enforcer</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    <form role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <img class="profile-user-img img-responsive" src="assets/dist/img/boxed-bg.jpg" alt="User profile picture">
                            </div>
                            <div class="form-group">
                                <label for="enf_pic">Upload Image</label>
                                <input type="file" class="btn btn-default col-md-12" id="enf_pic" name="enf_pic">
                            </div>
                            <div class="form-group">
                                <label for="enf_no">Enforcer ID Number:</label>
                                <input type="text" class="form-control" id="enf_id_no" name="enf_id_no"  placeholder="Enforcer ID Number">
                            </div>
                            <div class="form-group">
                                <label for="enf_lname">Last Name:</label>
                                <input type="text" class="form-control" id="enf_lname" name="enf_lname" placeholder="Last Name">
                            </div>
                            <div class="form-group">
                                <label for="enf_fname">First Name:</label>
                                <input type="text" class="form-control" id="enf_fname" name="enf_fname" placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <label for="enf_mname">Middle Name:</label>
                                <input type="text" class="form-control" id="enf_mname" name="enf_mname" placeholder="Middle Name">
                            </div>
                            <div class="form-group">
                                <label for="enf_pos">Position:</label>
                                <input type="text" class="form-control" id="enf_pos" name="enf_pos" placeholder="Position">
                            </div>
                            <div class="form-group">
                                <label for="uname">Username:</label>
                                <input type="text" class="form-control" id="uname" name="uname" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="pword">Password:</label>
                                <input type="password" class="form-control" id="pword" id="pword" placeholder="Password">
                            </div>
                            
                            
                            
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" id="addEnforcer" name="addEnforcer" class="btn btn-primary col-md-12">ADD</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                    <!-- /.end form -->
                </div>
                <!-- /.box -->
            </div>
            <!-- ./col -->

            <div class="col-md-8">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Enforcer</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="dtblEnforcer" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Enforcer ID No.</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Username</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Enforcer ID No.</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Username</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>


@endsection