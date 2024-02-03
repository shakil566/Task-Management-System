<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <li class="nav-item dropdown">

            <a class="nav-link" data-toggle="dropdown" href="#">
                <?php if(!empty(Auth::user()->photo)): ?>
                    <img class="img-circle user-icon"
                        src="<?php echo e(URL::to('/')); ?>/uploads/user/<?php echo e(Auth::user()->photo); ?>"
                        alt="<?php echo e(Auth::user()->official_name); ?>">
                <?php else: ?>
                    <img class="img-circle user-icon" src="<?php echo e(URL::to('/')); ?>/img/unknown.png" alt="">
                <?php endif; ?>
                <span class="nav-username"><?php echo e(Auth::user()->name); ?> <i
                        class="fas fa-angle-down"></i></span>
            </a>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">

                <a href="<?php echo e(url('admin/users/profile')); ?>" class="dropdown-item">
                    <i class="fa fa-user"></i> <?php echo app('translator')->get('english.MY_PROFILE'); ?>
                </a>

                <div class="dropdown-divider"></div>
                <a class=" dropdown-item" href="<?php echo e(route('logout.perform')); ?>">
                    <i class="fas fa-sign-out-alt"></i> <?php echo app('translator')->get('english.LOGOUT'); ?>
                </a>


            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('logout.perform')); ?>" title="<?php echo e(__('english.LOGOUT')); ?>">
                <i class="fas fa-sign-out-alt"></i>
            </a>

        </li>
    </ul>
</nav>
<?php /**PATH S:\Xampp_8.1.2\htdocs\TMS\resources\views/layouts/admin/navbar.blade.php ENDPATH**/ ?>