@extends('index')

@section('title', 'Violations')

@section('content')

    <section class="content-header">
        <h1>
            Maintenance
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-wrench"></i> Maintenance</a></li>
            <li class="active">Violation</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Violation</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    <form role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="vio_code">Violation Code</label>
                                <input type="text" class="form-control" id="vio_code" name="vio_code" placeholder="Violation Code">
                            </div>
                            <div class="form-group">
                                <label for="vio_desc">Violation Description</label>
                                <textarea class="form-control" id="vio_desc" name="vio_desc" placeholder="Violation Description"></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="vio_fee">Violation Fee</label>
                                <input type="text" class="form-control" id="vio_fee" placeholder="Violation Fee">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" id="addViolation" name="addViolation" class="btn btn-primary col-md-12">ADD</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!-- ./col -->

            <div class="col-md-8">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Violations</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="dtblViolation" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Violation Code</th>
                                    <th>Violation Description</th>
                                    <th>Violation Fee</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Violation Code</th>
                                    <th>Violation Description</th>
                                    <th>Violation Fee</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            
            </div>
        </div>
    </section>

@endsection