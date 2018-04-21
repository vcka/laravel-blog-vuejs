@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
<style type="text/css">
    .register-box {
        margin: 0 !important;
    }
</style>
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">User profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{ asset('admin/profile/' . Auth::user()->profile_image) }}" alt="User profile picture">

                        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                        <p class="text-muted text-center">@foreach (Auth::user()->roles as $role) {{ $role->name }},@endforeach</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Posts</b> <a class="pull-right">{{ number_format($postCount) }}</a>
                            </li>                            
                        </ul>                        
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->                
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#change-password" data-toggle="tab">Change Password</a></li>                        
                    </ul>
                    <div class="tab-content">                        
                        <div class="active tab-pane" id="change-password">
                            <div class="register-box">
                                <div class="register-box-body">
                                    <form class="form-horizontal" method="post" action="{{ route('user-profile.update', Auth::user()->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="cpassword" name="confirmed" placeholder="Retype Password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('footerSection')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
$(function () {
    $("#example1").DataTable();
});
</script>
@endsection