<?php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $cartCount = \App\Models\CartModel::where("user_id", $_SESSION["user"]["id"])->get()->count();
    $settings = \App\Models\SettingModel::find(0);
?>

<?php $__env->startSection("title", "Panel | $settings->title"); ?>
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Panel</a></li>
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
                            <div class="float-end mt-2">
                                <div id="total-revenue-chart"></div>
                            </div>
                            <div>
                                <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?php echo e($total_product_count); ?></span></h4>
                                <p class="mb-0"><a href="<?php echo e(url("backend.client.products")); ?>" class="text-muted text-decoration-underline">Tüm Ürünler</a></p>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-end mt-2">
                                <div id="orders-chart"></div>
                            </div>
                            <div>
                                <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?php echo e($pending_orders); ?></span></h4>
                                <p class="mb-0"><a href="<?php echo e(url("backend.client.orders")); ?>" class="text-muted text-decoration-underline">Bekleyen Siparişler</a></p>
                            </div>

                        </div>
                    </div>
                </div>

        </div> <!-- container-fluid -->
    </div>

    <script src="/public/backend-assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="/public/backend-assets/js/pages/dashboard.init.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("backend.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/yasingok/tekstil-demo.yasingokhanerdogan.com/resources/views/backend/clientArea/home/index.blade.php ENDPATH**/ ?>