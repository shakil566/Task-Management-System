<?php if(auth()->guard()->guest()): ?>
<?php else: ?>
<footer class="main-footer">
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#"><?php echo app('translator')->get('english.PROJECT_TITLE'); ?></a>.</strong>
    All rights reserved.
    
</footer>
<?php endif; ?>
<?php /**PATH S:\Xampp_8.1.2\htdocs\TMS\resources\views/layouts/admin/footer.blade.php ENDPATH**/ ?>