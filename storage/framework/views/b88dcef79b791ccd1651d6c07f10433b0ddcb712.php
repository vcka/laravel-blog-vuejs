<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo e(asset('admin/profile/' . Auth::user()->profile_image)); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo e(Auth::user()->name); ?></p>
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
            <li class="<?php echo e(($activeMenu['parent'] == 'dashboard' ? 'active' : '')); ?>"><a href="<?php echo e(route('admin.home')); ?>"><i class="fa fa-circle-o"></i><span> Dashboard</span></a></li>
            <?php if(in_array('blog', $menuController)): ?>
            <li class="treeview <?php echo e(($activeMenu['parent'] == 'blog' ? 'active' : '')); ?>">
                <a href="javascript:viod(0);">
                    <i class="fa fa-dashboard"></i> <span>BLOG</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="<?php echo e(($activeMenu['parent'] == 'blog' ? 'display: block' : 'display: none')); ?>">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('post.index',Auth::user())): ?>
                    <li class="<?php echo e(($activeMenu['child'] == 'post' ? 'active' : '')); ?>"><a href="<?php echo e(route('post.index')); ?>"><i class="fa fa-circle-o"></i> Posts</a></li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category.index',Auth::user())): ?>
                    <li class="<?php echo e(($activeMenu['child'] == 'category' ? 'active' : '')); ?>"><a href="<?php echo e(route('category.index')); ?>"><i class="fa fa-circle-o"></i> Categories</a></li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tag.index',Auth::user())): ?>
                    <li class="<?php echo e(($activeMenu['child'] == 'tag' ? 'active' : '')); ?>"><a href="<?php echo e(route('tag.index')); ?>"><i class="fa fa-circle-o"></i> Tags</a></li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('comment.index',Auth::user())): ?>
                    <li class="<?php echo e(($activeMenu['child'] == 'comment' ? 'active' : '')); ?>"><a href="<?php echo e(route('comment.index')); ?>"><i class="fa fa-circle-o"></i> Comments</a></li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array('acl', $menuController)): ?>
            <li class="treeview <?php echo e(($activeMenu['parent'] == 'acl' ? 'active' : '')); ?>">
                <a href="javascript:viod(0);">
                    <i class="fa fa-dashboard"></i> <span>ACL</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="<?php echo e(($activeMenu['parent'] == 'acl' ? 'display: block' : 'display: none')); ?>">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.index',Auth::user())): ?>
                    <li class="<?php echo e(($activeMenu['child'] == 'user' ? 'active' : '')); ?>"><a href="<?php echo e(route('user.index')); ?>"><i class="fa fa-circle-o"></i> Users</a></li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role.index',Auth::user())): ?>
                    <li class="<?php echo e(($activeMenu['child'] == 'role' ? 'active' : '')); ?>"><a href="<?php echo e(route('role.index')); ?>"><i class="fa fa-circle-o"></i> Roles</a></li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission.index',Auth::user())): ?>
                    <!--li class="<?php echo e(($activeMenu['child'] == 'permission' ? 'active' : '')); ?>"><a href="<?php echo e(route('permission.index')); ?>"><i class="fa fa-circle-o"></i> Permissions</a></li-->
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page.index',Auth::user())): ?>
                    <li class="<?php echo e(($activeMenu['child'] == 'page' ? 'active' : '')); ?>"><a href="<?php echo e(route('page.index')); ?>"><i class="fa fa-circle-o"></i> Controllers</a></li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('method.index',Auth::user())): ?>
                    <li class="<?php echo e(($activeMenu['child'] == 'method' ? 'active' : '')); ?>"><a href="<?php echo e(route('method.index')); ?>"><i class="fa fa-circle-o"></i> Actions</a></li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>