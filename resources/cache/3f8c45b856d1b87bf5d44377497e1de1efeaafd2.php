<!DOCTYPE html>
<html lang="tr">
<head>
    <?php echo $__env->make("frontend.layouts.dependencies.head", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script src='https://www.google.com/recaptcha/api.js?hl=tr'></script>

    <?php echo strip_tags($settings->analytics); ?>

</head>

<body>
<!-- Loader -->
<div id="loader">
    <div class="loading">
        <div></div>
    </div>
</div>

<?php echo $__env->make("frontend.layouts.includes.sidebar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content -->
<div class="togo-side-content">
    <!-- Lines -->
    <div class="content-lines-wrapper">
        <div class="content-lines-inner">
            <div class="content-lines"></div>
        </div>
    </div>

    <?php echo $__env->yieldContent("content"); ?>

    <?php if($_SERVER["REQUEST_URI"] != url("frontend.home")): ?>
        <?php echo $__env->make("frontend.layouts.includes.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

</div>

<?php echo $__env->make("frontend.layouts.dependencies.foot", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html><?php /**PATH /home/yasingok/tekstil-demo.yasingokhanerdogan.com/resources/views/frontend/layouts/master.blade.php ENDPATH**/ ?>