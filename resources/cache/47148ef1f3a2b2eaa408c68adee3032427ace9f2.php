<?php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $settings = \App\Models\SettingModel::find(0);
?>

<?php $__env->startSection("title", "Panel | $settings->company_name"); ?>
<?php $__env->startSection("content"); ?>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Kontrol Paneli</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Panel</li>
                                <li class="breadcrumb-item active">Kontrol Paneli</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <h4 class="mb-1 mt-1"><?php echo e($payment_notice_count); ?></h4>
                                <p class="text-muted mb-0"><a href="<?php echo e(url("backend.admin.paymentNotices")); ?>">Bekleyen Ödeme Bildirimleri</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <h4 class="mb-1 mt-1"><?php echo e($pending_order_count); ?></h4>
                                <p class="text-muted mb-0"><a href="<?php echo e(url("backend.admin.order.pendingOrders")); ?>">Bekleyen Siparişler</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <h4 class="mb-1 mt-1"><?php echo e($contact_inbox_count); ?></h4>
                                <p class="text-muted mb-0"><a href="<?php echo e(url("backend.admin.contactInbox")); ?>">Gelen İletişim Mesajları</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <h4 class="mb-1 mt-1"><?php echo e($category_count); ?></h4>
                                <p class="text-muted mb-0"><a href="<?php echo e(url("backend.admin.categories")); ?>">Kategoriler</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <h4 class="mb-1 mt-1"><?php echo e($bank_account_count); ?></h4>
                                <p class="text-muted mb-0"><a href="<?php echo e(url("backend.admin.bank.accounts")); ?>">Banka Hesapları</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <h4 class="mb-1 mt-1"><?php echo e($faq_count); ?></h4>
                                <p class="text-muted mb-0"><a href="<?php echo e(url("backend.admin.faqs")); ?>">S.S.S.</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <h4 class="mb-1 mt-1"><?php echo e($product_count); ?></h4>
                                <p class="text-muted mb-0"><a href="<?php echo e(url("backend.admin.products")); ?>">Ürünler</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("backend.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\teks\resources\views/backend/adminArea/home/index.blade.php ENDPATH**/ ?>