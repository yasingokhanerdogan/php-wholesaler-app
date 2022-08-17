<?php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $settings = \App\Models\SettingModel::find(0);
?>

<?php $__env->startSection("title", "Hesap Ekle | $settings->title"); ?>
<?php $__env->startSection("content"); ?>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Hesap Düzenle</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Panel</li>
                                <li class="breadcrumb-item"><a href="<?php echo e(url("backend.admin.banks")); ?>">Banka Hesapları</a></li>
                                <li class="breadcrumb-item active">Hesap Düzenle</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-3"></div>
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <form method="POST" action="<?php echo e(url("backend.admin.bank.account.update")); ?>" id="updateAccountForm">
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="bank_name" class="col-form-label">Banka*</label>
                                        <input class="form-control" type="text"
                                               value="<?php echo e($account->bank_name); ?>"
                                               id="bank_name"
                                               name="bank_name"
                                               placeholder="Banka">
                                    </div>
                                    <div class="mb-3">
                                        <label for="account_owner" class="col-form-label">Hesap Sahibi*</label>
                                        <input class="form-control" type="text"
                                               value="<?php echo e($account->account_owner); ?>"
                                               id="account_owner"
                                               name="account_owner"
                                               placeholder="Hesap Sahibi">
                                    </div>
                                    <div class="mb-3">
                                        <label for="iban" class="col-form-label">IBAN*</label>
                                        <input class="form-control" type="text"
                                               value="<?php echo e($account->iban); ?>"
                                               id="iban"
                                               name="iban"
                                               placeholder="IBAN No">
                                    </div>
                                </div>
                                <input type="hidden" name="account_id" value="<?php echo e($account->id); ?>">
                                <div class="mt-4">
                                    <button type="submit" id="updateAccount" class="btn btn-primary w-md">Kaydet</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("backend.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/httpdaff/tekstil-demo.yasingokhanerdogan.com/resources/views/backend/adminArea/bank-accounts/edit.blade.php ENDPATH**/ ?>