<?php $__env->startSection('content'); ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="<?php echo e(asset('css/cms/launch.css')); ?>">
    <div class="container" id="dashContainer">
        <div class="locationBar">
            <p style="margin-left: 1%"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a> / Dashboard</p>
            <hr style="width: 100%; color: black">
        </div>
        <div class="locationBody">
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin/dashboard", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/jayv/Projects/EngelsPraktijk/resources/views/admin/layouts/launch.blade.php ENDPATH**/ ?>