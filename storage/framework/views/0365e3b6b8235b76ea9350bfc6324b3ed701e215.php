<?php $__env->startSection('content'); ?>
        <?php if(Auth::user()): ?>
        <script type="text/javascript">window.location.href = "/home";</script>
        <?php endif; ?>
      <center>Welcome to e4Health Backend assistant demo</center>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\uddy\e4health\resources\views/welcome.blade.php ENDPATH**/ ?>