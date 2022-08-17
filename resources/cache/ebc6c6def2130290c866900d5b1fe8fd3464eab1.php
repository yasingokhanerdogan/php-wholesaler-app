<?php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $settings = \App\Models\SettingModel::find(0);
?>

<?php $__env->startSection("title", "Banka Hesapları | $settings->title"); ?>
<?php $__env->startSection("content"); ?>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Banka Hesapları</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Panel</li>
                                <li class="breadcrumb-item active">Banka Hesapları</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-2 mb-3">
                    <a href="<?php echo e(url("backend.admin.bank.account.add")); ?>" class="btn btn-success">Hesap Ekle</a>
                </div>
            </div>
            <div id="accountsArea"></div>

        </div> <!-- container-fluid -->
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("backend.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/httpdaff/tekstil-demo.yasingokhanerdogan.com/resources/views/backend/adminArea/bank-accounts/index.blade.php ENDPATH**/ ?>