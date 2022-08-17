
<?php $__env->startSection("title", "Hakkımızda | $settings->company_name"); ?>
<?php $__env->startSection("content"); ?>
    <section class="about pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-20">
                    <h6 class="small-title">HAKKIMIZDA</h6>
                    <h4 class="title">VİZYONUMUZ</h4>
                    <p><?php echo e($settings["vision"]); ?></p>
                </div>
                <div class="col-md-12 mb-20">
                    <h6 class="small-title">HAKKIMIZDA</h6>
                    <h4 class="title">MİSYONUMUZ</h4>
                    <p><?php echo e($settings["mission"]); ?></p>
                </div>
                <div class="col-md-12">
                    <div class="yearimg">
                        <div class="numb"><?php echo e($settings["experience_year"]); ?></div>
                    </div>
                    <div class="year">
                        <h6 class="small-title"><?php echo e($settings["experience_small_title"]); ?></h6>
                        <h4 class="title"><?php echo e($settings["experience_title"]); ?></h4>
                    </div>
                </div>

            </div>

        </div>
    </section>
<?php $__env->stopSection(); ?>




<?php echo $__env->make("frontend.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/yasingok/tekstil-demo.yasingokhanerdogan.com/resources/views/frontend/about-us/index.blade.php ENDPATH**/ ?>