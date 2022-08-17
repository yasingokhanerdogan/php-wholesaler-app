<div class="togo-fixed-sidebar togo-sidebar-left">
    <div class="togo-header-container">
        <!--Logo-->
        <div class="logo">
            <h1><a href="<?php echo e(url("frontend.home")); ?>">YGE<span>TEKSTİL A.Ş.</span></a></h1>
        </div>
        <!-- Burger menu -->
        <div class="burger-menu">
            <div class="line-menu line-half first-line"></div>
            <div class="line-menu"></div>
            <div class="line-menu line-half last-line"></div>
        </div>

        <nav class="togo-menu-fixed">
            <ul>
                <li><h5>Demo Site</h5></li>
                <li><a href="<?php echo e(url("frontend.home")); ?>">ANASAYFA</a></li>
                <li><a href="<?php echo e(url("frontend.about")); ?>">HAKKIMIZDA</a></li>
                <li><a href="<?php echo e(url("frontend.login")); ?>"><?php if(isset($_SESSION["user"]["id"])): ?> ÜYE PANEL <?php else: ?> ÜYE GİRİŞİ <?php endif; ?></a></li>
                <li><a href="<?php echo e(url("frontend.contact")); ?>">İLETİŞİM</a></li>
            </ul>
        </nav>

        <div class="togo-menu-social-media">
            <div class="social">
                <?php if($settings->facebook != ""): ?> <a href="<?php echo e($settings->facebook); ?>"><i class="ti-facebook"></i></a> <?php endif; ?>
                    <?php if($settings->twitter != ""): ?><a href="<?php echo e($settings->twitter); ?>"><i class="ti-twitter"></i></a> <?php endif; ?>
                    <?php if($settings->instagram != ""): ?><a href="<?php echo e($settings->instagram); ?>"><i class="ti-instagram"></i></a> <?php endif; ?>
                    <?php if($settings->pinterest != ""): ?><a href="<?php echo e($settings->pinterest); ?>"><i class="ti-pinterest"></i></a> <?php endif; ?>
                    <?php if($settings->youtube != ""): ?><a href="<?php echo e($settings->youtube); ?>"><i class="ti-youtube"></i></a> <?php endif; ?>
            </div>
            <div class="togo-menu-copyright">
                <p><?php echo $settings->copyright; ?></a></p>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\teks\resources\views/frontend/layouts/includes/sidebar.blade.php ENDPATH**/ ?>