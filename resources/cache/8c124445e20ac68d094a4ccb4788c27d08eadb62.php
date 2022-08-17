<?php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $settings = \App\Models\SettingModel::find(0);
?>

<?php $__env->startSection("title", "Ürün Listesi | $settings->title"); ?>
<?php $__env->startSection("content"); ?>
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Ürün Listesi</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Panel</a></li>
                                <li class="breadcrumb-item active">Ürünler</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-4">
                    <div>
                        <button type="button" onclick="location.href='<?php echo e(url("backend.admin.product.add")); ?>'" class="btn btn-success waves-effect waves-light mb-3"><i class="mdi mdi-plus me-1"></i> Ürün Ekle</button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">

                    <div id="productArea"></div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("backend.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/yasingok/tekstil-demo.yasingokhanerdogan.com/resources/views/backend/adminArea/products/index.blade.php ENDPATH**/ ?>