<!-- Sidebar Widgets Column -->
<div class="col-md-4">

    <!-- Search Widget -->
    <!--div class="card my-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button">Go!</button>
                </span>
            </div>
        </div>
    </div-->

    <!-- Categories Widget -->
    <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
            <div class="row">
                <ul class="list-unstyled mb-0">
                    @foreach ($categories as $key => $row)
                    <li><a href='{{ URL::to('/post/category/' . $row['slug']) }}'>{{ $row['name'] }} ({{ $row['post_count'] }})</a></li>            
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="card my-4">
        <h5 class="card-header">Archive</h5>
        <div class="card-body">
            <div class="row">
                <ul class="list-unstyled mb-0">
                    @foreach ($archive_data as $key => $row)

                    <li><a href='{{ URL::to('/archive/' . $key) }}'>{{ $key }} ({{ $row['total_post'] }})</a></li>
                    <ul>
                        @foreach($row['months'] as $mkey => $month)
                        <li><a href='{{ URL::to('/archive/' . $key . '/' . $month['month']) }}'>{{ $mkey }} ({{ $month['count'] }})</a></li>
                        @endforeach
                    </ul>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <!-- Tags Widget -->
    <div class="card my-4">
        <h5 class="card-header">Tags</h5>
        <div class="card-body">
            <div class="row">
                <ul class="list-unstyled mb-0">
                    @foreach ($tags as $key => $row)
                    <li><a href='{{ URL::to('/post/tag/' . $row['slug']) }}'>{{ $row['name'] }} ({{ $row['post_count'] }})</a></li>            
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <!-- Side Widget -->
    <!--div class="card my-4">
        <h5 class="card-header">Side Widget</h5>
        <div class="card-body">
            You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
        </div>
    </div-->
</div>