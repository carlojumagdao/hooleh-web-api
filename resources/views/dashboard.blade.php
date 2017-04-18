@extends('index')

@section('title', 'Dashboard')

@section('content')

    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <a href="{{ URL::to('/enforcer') }}">
                <div class="col-sm-6 col-md-3 col-lg-2">
                    <div class="custom-box">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="assets/image/icons/userIcon.png" alt="User profile picture">
                            <h3 class="profile-username text-center">Enforcers</h3>
                            <p class="text-muted text-center">Add and manage enforcers</p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="/">
            <div class="col-sm-6 col-md-3 col-lg-2">
                <div class="custom-box">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="assets/image/icons/driverIcon.png" alt="User profile picture">
                        <h3 class="profile-username text-center">Drivers</h3>
                        <p class="text-muted text-center">Track drivers</p>
                    </div>
                </div>
            </div>
            </a>
            <a href="/violation">
            <div class="col-sm-6 col-md-3 col-lg-2">
                <div class="custom-box">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="assets/image/icons/violationIcon.png" alt="User profile picture">
                        <h3 class="profile-username text-center">Violations</h3>
                        <p class="text-muted text-center">Add and manage violations</p>
                    </div>
                </div>
            </div>
            </a>
            <a href="/">
            <div class="col-sm-6 col-md-3 col-lg-2">
                <div class="custom-box">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="assets/image/icons/adminIcon.png" alt="User profile picture">
                        <h3 class="profile-username text-center">Admin Role</h3>
                        <p class="text-muted text-center">Add new admins</p>
                    </div>
                </div>
            </div>
            </a>
            <a href="/">
            <div class="col-sm-6 col-md-3 col-lg-2">
                <div class="custom-box">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="assets/image/icons/reportIcon.png" alt="User profile picture">
                        <h3 class="profile-username text-center">Reports</h3>
                          <p class="text-muted text-center">Track usage of service</p>
                    </div>
                </div>
            </div>
            </a>
            <a href="/">
            <div class="col-sm-6 col-md-3 col-lg-2">
                <div class="custom-box">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="assets/image/icons/supportIcon.png" alt="User profile picture">
                        <h3 class="profile-username text-center">Support</h3>
                        <p class="text-muted text-center">Talk with our support team</p>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </section>
@endsection