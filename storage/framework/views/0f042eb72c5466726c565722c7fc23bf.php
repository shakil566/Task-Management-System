<?php
$currentControllerFunction = Route::currentRouteAction();
$currentCont = preg_match(
    '/([a-z]*)@/i',
    request()
        ->route()
        ->getActionName(),
    $currentControllerFunction,
);
$currentControllerName = Request::segment(2);
// dd($currentControllerName);
$currentFullRouteName = Route::getFacadeRoot()
    ->current()
    ->uri();
$action = Route::currentRouteAction();
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="<?php echo e(url('/dashboard')); ?>" class="brand-link">
        <img src="<?php echo e(asset('backend')); ?>/dist/img/AdminLogo.png" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo app('translator')->get('english.PROJECT_TITLE'); ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="<?php echo e(url('dashboard/admin')); ?>" class="nav-link active">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            <?php echo app('translator')->get('english.DASHBOARD'); ?>
                        </p>
                    </a>
                </li>

                <?php if(Auth::user()->user_group_id != '2'): ?>
                <li class="nav-item parent menu-item-has-children <?php echo in_array($currentControllerName, ['userGroup', 'users', 'teammates']) ? 'act' : ''; ?>">
                    <a href="#" class="nav-link parent-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            <?php echo app('translator')->get('english.USER_SETUP'); ?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview admin-nav sub-menu <?php echo in_array($currentControllerName, ['userGroup', 'users', 'teammates']) ? 'visible' : ''; ?>">
                        <li class="nav-item <?php echo $currentControllerName == 'userGroup' ? 'act' : ''; ?>">
                            <a href="<?php echo e(URL::to('admin/userGroup')); ?>" class="nav-link">
                                <i class="fas fa-users nav-icon"></i>
                                <p><?php echo app('translator')->get('english.USER_GROUP'); ?></p>
                            </a>
                        </li>
                        <li class="nav-item <?php echo $currentControllerName == 'users' ? 'act' : ''; ?>">
                            <a href="<?php echo e(URL::to('admin/users')); ?>" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p><?php echo app('translator')->get('english.USER'); ?></p>
                            </a>
                        </li>
                        <li class="nav-item <?php echo $currentControllerName == 'teammates' ? 'act' : ''; ?>">
                            <a href="<?php echo e(URL::to('admin/teammates')); ?>" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p><?php echo app('translator')->get('english.TEAMMATES'); ?></p>
                            </a>
                        </li>
                    </ul>
                </li>

                <?php endif; ?>

                <li class="nav-item parent menu-item-has-children <?php echo in_array($currentControllerName, ['task', 'project', 'assignedTask', 'taskInfo']) ? 'act' : ''; ?>">
                    <a href="#" class="nav-link parent-link">
                        <i class="nav-icon fas fa-project-diagram"></i>
                        <p>
                            <?php echo app('translator')->get('english.PROJECT_MANAGEMENT'); ?>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview admin-nav sub-menu <?php echo in_array($currentControllerName, ['task', 'project', 'assignedTask', 'taskInfo']) ? 'visible' : ''; ?>">
                        <?php if(Auth::user()->user_group_id != '2'): ?>
                        <li class="nav-item <?php echo $currentControllerName == 'project' ? 'act' : ''; ?>">
                            <a href="<?php echo e(url('admin/project')); ?>" class="nav-link">
                                <i class="fas fa-award"></i>
                                <p><?php echo app('translator')->get('english.PROJECT'); ?></p>
                            </a>
                        </li>
                        <li class="nav-item <?php echo $currentControllerName == 'task' ? 'act' : ''; ?>">
                            <a href="<?php echo e(url('admin/task')); ?>" class="nav-link">
                                <i class="fa fa-list-alt"></i>
                                <p><?php echo app('translator')->get('english.TASK'); ?></p>
                            </a>
                        </li>
                        <li class="nav-item <?php echo $currentControllerName == 'assignedTask' ? 'act' : ''; ?>">
                            <a href="<?php echo e(url('admin/assignedTask')); ?>" class="nav-link">
                                <i class="fas fa-tasks"></i>
                                <p><?php echo app('translator')->get('english.ASSIGNED_TASK'); ?></p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(Auth::user()->user_group_id == '2'): ?>
                        <li class="nav-item <?php echo $currentControllerName == 'taskInfo' ? 'act' : ''; ?>">
                            <a href="<?php echo e(url('admin/taskInfo')); ?>" class="nav-link">
                                <i class="fas fa-tasks"></i>
                                <p><?php echo app('translator')->get('english.MY_TASK'); ?></p>
                            </a>
                        </li>
                        <?php endif; ?>

                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside><?php /**PATH S:\Xampp_8.1.2\htdocs\TMS\resources\views/layouts/admin/sidebar.blade.php ENDPATH**/ ?>