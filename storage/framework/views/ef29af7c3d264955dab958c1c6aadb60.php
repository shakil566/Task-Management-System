<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <title><?php echo app('translator')->get('english.PROJECT_TITLE'); ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo e(asset('backend')); ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo e(asset('backend')); ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('backend')); ?>/css/style.css">
    
    <link rel="stylesheet" href="<?php echo e(asset('backend')); ?>/css/custom.css">





    <!-- DataTables -->
    <link rel="stylesheet"
        href="<?php echo e(asset('backend')); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?php echo e(asset('backend')); ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?php echo e(asset('backend')); ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo e(asset('backend')); ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet"
        href="<?php echo e(asset('backend')); ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet"
        href="<?php echo e(asset('backend')); ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet"
        href="<?php echo e(asset('backend')); ?>/plugins/sweetalert2-theme-bootstrap-4/sweetalert2.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo e(asset('backend')); ?>/plugins/toastr/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('backend')); ?>/dist/css/admin.css">
    <link rel="stylesheet" href="<?php echo e(asset('backend')); ?>/dist/css/admin.css.map">
    <link rel="stylesheet" href="<?php echo e(asset('backend')); ?>/dist/css/admin.min.css.map">


    <link rel="shortcut icon" type="image/icon" href="<?php echo e(asset('/')); ?>img/shortcut_icon.png" />
    
    
    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>

</head>

<body>
    
    <div class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

        <?php if(auth()->guard()->guest()): ?>
        <?php else: ?>
            <div class="wrapper">

                <!-- Preloader -->
                <div class="preloader flex-column justify-content-center align-items-center">
                    <img class="animation__wobble" src="<?php echo e(asset('/')); ?>img/pre_loader.png"
                        alt="Pre Loader Logo"
                        
                        height="60" width="60"
                        >
                </div>

                <!-- Navbar -->
                <?php echo $__env->make('layouts.admin.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- /.navbar -->

                <!-- Main Sidebar Container -->
                <?php echo $__env->make('layouts.admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- End Sidebar Container -->
            <?php endif; ?>
            <!-- Content Wrapper. Contains page content -->
            <?php echo $__env->yieldContent('admin_content'); ?>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <?php echo $__env->make('layouts.admin.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    
    <!-- jQuery -->
    <script src="<?php echo e(asset('backend')); ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo e(asset('backend')); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?php echo e(asset('backend')); ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- Admin App -->
    <script src="<?php echo e(asset('backend')); ?>/dist/js/admin.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="<?php echo e(asset('backend')); ?>/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="<?php echo e(asset('backend')); ?>/plugins/raphael/raphael.min.js"></script>
    <script src="<?php echo e(asset('backend')); ?>/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="<?php echo e(asset('backend')); ?>/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="<?php echo e(asset('backend')); ?>/plugins/chart.js/Chart.min.js"></script>

    <!-- Admin for demo purposes -->
    <script src="<?php echo e(asset('backend')); ?>/dist/js/demo.js"></script>
    <!-- Admin dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo e(asset('backend')); ?>/dist/js/pages/dashboard2.js"></script>

    <!-- Select2 -->
        <script src="<?php echo e(asset('backend')); ?>/plugins/select2/js/select2.full.min.js"></script>
        <script>
            $(function() {
                //Initialize Select2 Elements
                $('.select2').select2()

                //Initialize Select2 Elements
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })

            });
        </script>
        <script>
            // main menu toggle of sub-menu
            $(".menu-item-has-children > a").click(function(e) {
                // check active
                var isCurrentActive = $(this).next('.sub-menu').hasClass('visible')

                // remove .visible from other .sub-menu
                $(".sub-menu").removeClass('visible');

                // if current menu deactive add visible
                if (!isCurrentActive) {
                    $(this).next(".sub-menu").addClass('visible');
                }

                // prevent the <a> from default behavior
                e.preventDefault();
            });
        </script>

        <!-- DataTables  & Plugins -->
        <script src="<?php echo e(asset('backend')); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo e(asset('backend')); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo e(asset('backend')); ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo e(asset('backend')); ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="<?php echo e(asset('backend')); ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo e(asset('backend')); ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo e(asset('backend')); ?>/plugins/jszip/jszip.min.js"></script>
        <script src="<?php echo e(asset('backend')); ?>/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="<?php echo e(asset('backend')); ?>/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="<?php echo e(asset('backend')); ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="<?php echo e(asset('backend')); ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="<?php echo e(asset('backend')); ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>



        <!-- SweetAlert2 -->
        <script src="<?php echo e(asset('backend')); ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
        <script src="<?php echo e(asset('backend')); ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
        <!-- Toastr -->
        <script src="<?php echo e(asset('backend')); ?>/plugins/toastr/toastr.min.js"></script>
</body>

</html>
<?php /**PATH S:\Xampp_8.1.2\htdocs\TMS\resources\views/layouts/admin/master.blade.php ENDPATH**/ ?>