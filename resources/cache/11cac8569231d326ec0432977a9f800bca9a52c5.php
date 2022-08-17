<?php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $cartCount = \App\Models\CartModel::where("user_id", $_SESSION["user"]["id"])->get()->count();
    $settings = \App\Models\SettingModel::find(0);
?>

<?php $__env->startSection("title", "Ödeme Bildirimi Yap | $settings->title"); ?>
<?php $__env->startSection("content"); ?>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Ödeme Bildirimi Yap</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Panel</li>
                                <li class="breadcrumb-item"><a href="<?php echo e(url("backend.client.paymentNotices")); ?>">Ödeme Bildirimlerim</a></li>
                                <li class="breadcrumb-item active">Ödeme Bildirimi Yap</li>
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

                            <form method="POST" action="<?php echo e(url("backend.client.paymentNotice.create")); ?>" id="createPaymentNoticeForm">
                                <input type="hidden" value="<?php echo e($authUser->id); ?>" name="user_id" style="display: none;">

                                <div class="row">
                                    <div class="mb-3">
                                        <label for="bank_account" class="col-form-label">Fiyat Göster*</label>
                                        <select class="form-control" id="bank_account" name="bank_account">
                                            <option value="">Bank Seçin.</option>
                                            <?php $__currentLoopData = $bank_accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($item->bank_name); ?>"> <?php echo e($item->bank_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="total_amount" class="col-form-label">Ödeme Tutarı*</label>
                                        <span class="text-muted"> (Orn.1000.00₺)</span>
                                        <input class="form-control" type="number"
                                               value=""
                                               id="total_amount"
                                               name="total_amount"
                                               placeholder="Ödeme Tutarı">
                                    </div>
                                    <div class="mb-3">
                                        <label for="order_no" class="col-form-label">Sipariş No*</label>
                                        <select class="form-control" id="order_no" name="order_no">
                                            <option value="">Sipariş No Seçin.</option>
                                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($item->order_no); ?>"> #<?php echo e($item->order_no); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="col-form-label">Ad Soyad*</label>
                                        <input class="form-control" type="text"
                                               value="<?php echo e($authUser->name . " " . $authUser->surname); ?>"
                                               id="name"
                                               name="name"
                                               placeholder="Ad Soyad">
                                    </div>

                                    <div class="mb-3">
                                        <label for="company_name" class="col-form-label">Şirket Adı*</label>
                                        <input class="form-control" type="text"
                                               value="<?php echo e($authUser->company_name); ?>"
                                               id="company_name"
                                               name="company_name"
                                               placeholder="Şirket Adı">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="col-form-label">Email*</label>
                                        <input class="form-control" type="text"
                                               value="<?php echo e($authUser->email); ?>"
                                               id="email"
                                               name="email" placeholder="Email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="col-form-label">Telefon*</label>
                                        <input class="form-control" type="number"
                                               value="<?php echo e($authUser->phone); ?>"
                                               id="phone"
                                               name="phone"
                                               placeholder="Telefon">
                                    </div>
                                    <div class="mb-3">
                                        <label for="identity_number" class="col-form-label">TC Kimlik No*</label>
                                        <input class="form-control" type="number"
                                               value="<?php echo e($authUser->identity_number); ?>"
                                               id="identity_number"
                                               name="identity_number"
                                               placeholder="TC Kimlik No">
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" id="createPaymentNotice" class="btn btn-primary w-md">Gönder
                                    </button>
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

<?php echo $__env->make("backend.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/httpdaff/tekstil-demo.yasingokhanerdogan.com/resources/views/backend/clientArea/payment-notices/add.blade.php ENDPATH**/ ?>