<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('admin/profile/' . Auth::user()->profile_image) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
            </div>
        </div>
        <!-- search form -->
        <form action="javascript:viod(0);" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ ($activeMenu['parent'] == 'dashboard' ? 'active' : '') }}"><a href="{{ route('admin.home') }}"><i class="fa fa-circle-o"></i><span> Dashboard</span></a></li>
            @if (in_array('blog', $menuController))
            <li class="treeview {{ ($activeMenu['parent'] == 'blog' ? 'active' : '') }}">
                <a href="javascript:viod(0);">
                    <i class="fa fa-dashboard"></i> <span>BLOG</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="{{ ($activeMenu['parent'] == 'blog' ? 'display: block' : 'display: none') }}">
                    @can('post.index',Auth::user())
                    <li class="{{ ($activeMenu['child'] == 'post' ? 'active' : '') }}"><a href="{{ route('post.index') }}"><i class="fa fa-circle-o"></i> Posts</a></li>
                    @endcan
                    @can('category.index',Auth::user())
                    <li class="{{ ($activeMenu['child'] == 'category' ? 'active' : '') }}"><a href="{{ route('category.index') }}"><i class="fa fa-circle-o"></i> Categories</a></li>
                    @endcan
                    @can('tag.index',Auth::user())
                    <li class="{{ ($activeMenu['child'] == 'tag' ? 'active' : '') }}"><a href="{{ route('tag.index') }}"><i class="fa fa-circle-o"></i> Tags</a></li>
                    @endcan
                    @can('comment.index',Auth::user())
                    <li class="{{ ($activeMenu['child'] == 'comment' ? 'active' : '') }}"><a href="{{ route('comment.index') }}"><i class="fa fa-circle-o"></i> Comments</a></li>
                    @endcan
                </ul>
            </li>
            @endif
            @if (in_array('acl', $menuController))
            <li class="treeview {{ ($activeMenu['parent'] == 'acl' ? 'active' : '') }}">
                <a href="javascript:viod(0);">
                    <i class="fa fa-dashboard"></i> <span>ACL</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="{{ ($activeMenu['parent'] == 'acl' ? 'display: block' : 'display: none') }}">
                    @can('user.index',Auth::user())
                    <li class="{{ ($activeMenu['child'] == 'user' ? 'active' : '') }}"><a href="{{ route('user.index') }}"><i class="fa fa-circle-o"></i> Users</a></li>
                    @endcan
                    @can('role.index',Auth::user())
                    <li class="{{ ($activeMenu['child'] == 'role' ? 'active' : '') }}"><a href="{{ route('role.index') }}"><i class="fa fa-circle-o"></i> Roles</a></li>
                    @endcan
                    @can('permission.index',Auth::user())
                    <!--li class="{{ ($activeMenu['child'] == 'permission' ? 'active' : '') }}"><a href="{{ route('permission.index') }}"><i class="fa fa-circle-o"></i> Permissions</a></li-->
                    @endcan
                    @can('page.index',Auth::user())
                    <li class="{{ ($activeMenu['child'] == 'page' ? 'active' : '') }}"><a href="{{ route('page.index') }}"><i class="fa fa-circle-o"></i> Controllers</a></li>
                    @endcan
                    @can('method.index',Auth::user())
                    <li class="{{ ($activeMenu['child'] == 'method' ? 'active' : '') }}"><a href="{{ route('method.index') }}"><i class="fa fa-circle-o"></i> Actions</a></li>
                    @endcan
                </ul>
            </li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>