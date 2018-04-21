@extends('admin.layouts.app')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/css/role.css') }}">
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Role
            <small>Edit {{ $role->name }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('role.index') }}">List</a></li>
            <li class="active">Roles</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Role</h3>
                    </div>

                    @include('includes.messages')
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('role.update',$role->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="box-body">
                            <div class="col-lg-offset-3 col-lg-6">
                                <div class="form-group">
                                    <label for="name">Role title</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="role Title" value="{{ $role->name }}">
                                </div>

                                <div class="row">



                                    <div class="col-lg-6">
                                        <label for="name">Modules</label>

                                        <div id="vertical-menu">
                                            <ul>
                                                <li><h3><input type="checkbox" class="all_checkbox" value="1"> All</h3></li>
                                            </ul>
                                            <ul>


                                                @foreach ($pages as $page)

                                                <li class="mainLi">
                                                    <h3><span class="plus">+</span><input type="checkbox" class="parent_checkbox_{{ $page->id }} parent_checkbox" data-id="{{ $page->id }}" @if(in_array($page->id, $checked['rolePage'])) {{ 'checked' }} @endif name="pages[]" value="{{ $page->id }}">{{ $page->label }}</h3>
                                                    <ul>
                                                        @foreach($page->methods as $method)
                                                        <li><input type="checkbox" class="child_checkbox_{{ $page->id }} child_checkbox" data-parent-id="{{ $page->id }}" @if(in_array($method->id, $checked['roleMethods'])) {{ 'checked' }} @endif name="methods[]" value="{{ $method->id }}"> {{ $method->label }}</li>
                                                        @endforeach
                                                    </ul>
                                                </li>

                                                @endforeach


                                            </ul>
                                        </div> 

                                    </div>
                                </div>



                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href='{{ route('role.index') }}' class="btn btn-warning">Back</a>
                                </div>

                            </div>

                        </div>

                    </form>
                </div>
                <!-- /.box -->


            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('footerSection')
    <script src="{{ asset('admin/js/role.js') }}"></script>    
@endsection