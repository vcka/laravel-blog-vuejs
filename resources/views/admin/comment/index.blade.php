@extends('admin.layouts.app')
@section('headSection')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
@endsection
@section('main-content')
<!-- Content Wrapper. Contains method content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Comments List</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> Home</a></li>            
            <li class="active">Comments</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div id="message"></div>
        <!-- Default box -->
        <div class="box box-warning">
            <div class="box-body">                
                <div class="box-tools pull-right" style="margin-top: -16px;">
                    {{ $comments->links() }}
                </div>
                <table id="example" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10%;">S.No</th>
                            <th style="width: 10%;">User Name</th>
                            <th style="width: 10%;">User Email</th>
                            <th style="width: 40%;">Comment</th>
                            <th style="width: 20%;">Post Title</th>
                            <th style="width: 10%;">Approve</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                        <tr>

                            <td>{{ (($comments->currentPage() - 1) * $comments->perPage()) + $loop->iteration }}</td>
                            <td>{{ $comment->name }}</td>
                            <td>{{ $comment->email }}</td>
                            <td>{{ $comment->comment }}</td>
                            <td>{{ $comment->title }}</td>
                            <td>                                
                                <input 
                                    type="checkbox" data-off-label="false" 
                                    data-on-label="false" 
                                    data-off-icon-cls="glyphicon-thumbs-down" 
                                    data-on-icon-cls="glyphicon-thumbs-up"
                                    data-id = '{{ $comment->id }}' data-status = '{{ $comment->approved }}'
                                    @if(!empty($comment->approved)) {{ 'checked="checked"' }} @endif
                                    >
                            </td>                            
                        </tr>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>S.No</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>Comment</th>
                            <th>Post Title</th>
                            <th>Edit</th>                            
                        </tr>
                    </tfoot>
                </table>
                <div class="box-tools pull-right">
                    {{ $comments->links() }}
                </div>                        
            </div>                    
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('footerSection')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-checkbox/1.4.0/bootstrap-checkbox.min.js"></script>
<script src="{{ asset('admin/custom/comments.js') }}"></script>
@endsection