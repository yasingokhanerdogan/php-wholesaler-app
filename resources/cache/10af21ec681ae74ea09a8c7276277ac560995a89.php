<?php

    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $cartCount = \App\Models\CartModel::where("user_id", $_SESSION["user"]["id"])->get()->count();
    $settings = \App\Models\SettingModel::find(0);

?>

        <!doctype html>
<html lang="tr">
<head>
    <?php echo $__env->make("backend.layouts.dependencies.head", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        .whatsapp-support {
            position: fixed;
            bottom: 50px;
            left: 50px;
            width: 45px;
            height: 45px;
            z-index: 9990;
        }

        .whatsapp-support img {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
<div id="layout-wrapper">

    <?php echo $__env->make("backend.layouts.includes.header", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make("backend.layouts.includes.sidebar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="main-content">

        <?php echo $__env->yieldContent("content"); ?>

        <?php echo $__env->make("backend.layouts.includes.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

</div>

<?php echo $__env->make("backend.layouts.dependencies.foot", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if($authUser->role == "client"): ?>
    <div class="whatsapp-support">
        <a href="https://wa.me/90<?php echo e($settings->whatsapp); ?>">
            <img src="/public/backend-assets/uploads/whatsapp.png" alt="#">
        </a>
    </div>
<?php endif; ?>
</body>
</html>
<?php /**PATH /home/yasingok/tekstil-demo.yasingokhanerdogan.com/resources/views/backend/layouts/master.blade.php ENDPATH**/ ?>