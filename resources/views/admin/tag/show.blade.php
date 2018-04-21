@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tag Lists
            <!--small>it all starts here</small-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> Home</a></li>      
            <li class="active">Tag Lists</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Tags</h3>

                <div class="box-tools pull-right">
                    @can('tag.create', Auth::user())
                    <a class='btn btn-success' href="{{ route('tag.create') }}">Add New</a>
                    @endcan
                </div>
            </div>
            <div class="box-body">
                <div class="box">                    
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Tag Name</th>
                                    <th>Slug</th>
                                    @can('tag.edit', Auth::user())
                                    <th>Edit</th>
                                    @endcan
                                    @can('tag.destroy', Auth::user())
                                    <th>Delete</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tags as $tag)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $tag->name }}</td>
                                    <td>{{ $tag->slug }}</td>
                                    @can('tag.edit', Auth::user())                            
                                    <td><a href="{{ route('tag.edit',$tag->id) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
                                    @endcan                              
                                    @can('tag.destroy', Auth::user())                            
                                    <td>
                                        <form id="delete-form-{{ $tag->id }}" method="post" action="{{ route('tag.destroy',$tag->id) }}" style="display: none">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
                                        <a href="" onclick="
                                                    if (confirm('Are you sure, You Want to delete this?'))
                                            {
                                            event.preventDefault();
                                            document.getElementById('delete-form-{{ $tag->id }}').submit();
                                                }
                                                else{
                                                event.preventDefault();
                                                }" ><span class="glyphicon glyphicon-trash"></span></a>
                                    </td>
                                    @endcan
                                </tr>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>S.No</th>
                                    <th>Tag Name</th>
                                    <th>Slug</th>
                                    @can('tag.edit', Auth::user())
                                    <th>Edit</th>
                                    @endcan
                                    @can('tag.destroy', Auth::user())
                                    <th>Delete</th>
                                    @endcan
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                Footer
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

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