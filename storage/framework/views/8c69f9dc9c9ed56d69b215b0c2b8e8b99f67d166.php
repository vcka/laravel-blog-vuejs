<?php $__env->startSection('headSection'); ?>
<link rel="stylesheet" href="<?php echo e(asset('admin/plugins/datatables/dataTables.bootstrap.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="margin: 15px;">
        <ol class="breadcrumb">
            <li><a href="/admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Post List</li>
        </ol>
    </section>



    <!-- Main content -->
    <section class="content">
        <div class="box box-danger collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title">Search</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                        <i class="fa fa-plus"></i>
                    </button>                    
                </div>
            </div>
            <div class="box-body" style="display: none">
                <div class="row">
                    <div class="col-xs-3">
                        <input type="text" class="form-control" name="search_title" id="search_title" placeholder="Title" value="">
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" name="search_subtitle" id="search_subtitle" placeholder="Sub Title" value="">
                    </div>
                    <div class="col-xs-3">
                        <button type="button" id="submitButton" class="btn btn-primary">Search</button>
                        <button type="button" id="resetButton" class="btn btn-primary">Reset</button>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Post Listing</h3>
                        <div class="box-tools">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('post.create', Auth::user())): ?>
                            <a class='col-lg-offset-0 btn btn-success' href="<?php echo e(route('post.create')); ?>">Add New</a>
                            <?php endif; ?>
                            <!--a class='col-lg-offset-0 btn btn-success' id="change_publish_status" href="javascript:void(0);">Change Publish Status</a-->
                        </div>
                    </div>
                    <br/>
                    <div class="box-body no-padding" style="width: 1080px; margin-left: 5px; margin-bottom: 10px;">
                        <table id="list_records"></table>
                        <div id="grid-pager"></div>
                    </div>
                    <br/>                    
                </div>                
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footerSection'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqgrid/4.6.0/js/i18n/grid.locale-en.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqgrid/4.6.0/js/jquery.jqGrid.min.js"></script>
<script type="text/javascript">
var gridOptions = {
    url: "<?php echo e(route('post.data')); ?>",
    colNames: ["SNo.", "Title", "Sub Title", "Created At", "Status", "Edit", "Delete"],
    colModel: [
        {name: "sno", width: '5%', align: "center"},
        {name: "title", width: '25%'},
        {name: "subtitle", width: '25%'},
        {name: "created_at", width: '15%'},
        {name: "status", width: '7%'},
        {name: "edit", width: '5%'},
        {name: "delete", width: '5%'}
    ],
    gridId: "list_records",
    grid: $('#list_records'),
    pager: '#grid-pager',
    sortname: 'created_at',
    sortorder: "desc",
    height: '325px'
}
</script>
<script src="<?php echo e(asset('admin/custom/grid.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>