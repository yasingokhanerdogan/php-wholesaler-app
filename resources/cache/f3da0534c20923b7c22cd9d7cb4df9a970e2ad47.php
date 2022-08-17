<?php $__env->startSection("title", "Üye Girişi | $settings->company_name"); ?>
<?php $__env->startSection("content"); ?>
    <section class="contact pt-100 pb-100">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12 mb-20">
                    <h6 class="small-title">Perakendeci</h6>
                    <h4 class="title">Üye Girişi</h4>
                </div>
            </div>
            <div class="row pb-100">
                <div class="col-md-6 offset-md-3">
                    <form method="POST" action="<?php echo e(url("frontend.signin")); ?>" class="form" id="loginForm">
                        <input type="hidden" name="csrf_token" value="<?php echo e(csrf_token()); ?>">
                        <div id="login_error"></div>
                        <div class="controls">
                            <div class="row">
                                 <div class="mb-3 d-flex justify-content-center w-100">
                                    <div class="col-md-6 text-center">
                                        <button type="button" class="btn" id="fillUserBtn"><span>Kullanıcı</span></button>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <button type="button" class="btn" id="fillAdminBtn"><span>Admin</span></button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input id="username" type="text" name="username" placeholder="Kullanıcı Adı veya Email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input id="password" type="password" name="password" placeholder="Şifre">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 text-right">
                                    <a href="<?php echo e(url("frontend.changePassword.emailScreen")); ?>"> Şifremi Unuttum/Değiştir</a>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn"><span>Giriş Yap<i
                                                class="ti-arrow-right"></i></span></button>
                                </div>
                               
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        const username = document.querySelector("#username");
        const password = document.querySelector("#password");
        
        const fillUserBtn = document.querySelector("#fillUserBtn");
        const fillAdminBtn = document.querySelector("#fillAdminBtn");
        
        fillUserBtn.addEventListener("click", ()=>{
            username.value = "ygeclient";
            password.value = "123456";
        });
        
        fillAdminBtn.addEventListener("click", ()=>{
            username.value = "ygeadmin";
            password.value = "123456";
        });
        
    </script>  
<?php $__env->stopSection(); ?>

<?php echo $__env->make("frontend.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/httpdaff/tekstil-demo.yasingokhanerdogan.com/resources/views/frontend/login/index.blade.php ENDPATH**/ ?>