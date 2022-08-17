<!doctype html>
<html lang="tr">
<head>
    <title>Sayfa Bulunamadı! | <?php echo e($settings->company_name); ?></title>
    <?php echo $__env->make("backend.layouts.dependencies.head", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

    <body>

        <div class="my-5 pt-sm-5">
            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <div>
                                <div class="row justify-content-center">
                                    <div class="col-sm-4">
                                        <div class="error-img">
                                            <img src="/public/backend-assets/images/404-error.png" alt="" class="img-fluid mx-auto d-block">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4 class="text-uppercase mt-4 font-size-24">Sayfa Bulunamadı!</h4>
                            <div class="mt-5">
                                <a class="btn btn-primary waves-effect waves-light" href="<?php echo e(url("frontend.login")); ?>">Anasayfa'ya Dön</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php echo $__env->make("backend.layouts.dependencies.foot", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
</html>
<?php /**PATH /home/yasingok/tekstil-demo.yasingokhanerdogan.com/resources/views/errors/index.blade.php ENDPATH**/ ?>