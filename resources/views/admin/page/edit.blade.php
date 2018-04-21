@extends('admin.layouts.app')

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Controller
            <small>Edit {{$page->name}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('page.index') }}">List</a></li>
            <li class="active">Edit Controller</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Controller</h3>
                    </div>

                    @include('includes.messages')
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('page.update',$page->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="box-body">
                            <div class="col-lg-offset-3 col-lg-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $page->name }}">
                                </div>

                                <div class="form-group">
                                    <label for="slug">Label</label>
                                    <input type="text" class="form-control" id="slug" name="label" placeholder="Label" value="{{ $page->label }}"> 
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href='{{ route('page.index') }}' class="btn btn-warning">Back</a>
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