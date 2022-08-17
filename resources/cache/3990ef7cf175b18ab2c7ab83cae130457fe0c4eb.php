<?php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $cartCount = \App\Models\CartModel::where("user_id", $_SESSION["user"]["id"])->get()->count();
    $settings = \App\Models\SettingModel::find(0);
?>

<?php $__env->startSection("title", "Ürünler | $settings->title"); ?>
<?php $__env->startSection("content"); ?>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Arama Sonuçları</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Panel</li>
                                <li class="breadcrumb-item active">Ürünler</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <?php if($products->count() != 0): ?>

                    <div class="col-xl-3 col-lg-4">
                        <div class="card">
                            <div class="card-header bg-transparent border-bottom">
                                <h5 class="mb-0">Kategoriler</h5>
                            </div>

                            <div class="p-4">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($category->getProducts->count() > 0): ?>
                                        <a class="text-body fw-semibold pb-2 d-block"
                                           href="<?php echo e(url("backend.client.category", ["slug" => $category->slug])); ?>"
                                           role="button">
                                            <?php echo e($category->title); ?>

                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-xl-9 col-lg-8"> -->

                    <div class="col-xl-9 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-xl-4 col-sm-6">
                                            <div class="product-box">
                                                <div class="product-img pt-4 px-4">
                                                    <?php if($authUser->show_price == "1"): ?>
                                                        <?php if($product->stock != 0): ?>
                                                            <?php if($product->discount_rate != 0): ?>
                                                                <div class="product-ribbon badge bg-success">
                                                                    - <?php echo e($product->discount_rate); ?>%
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <div class="product-ribbon badge bg-danger">
                                                                Stokta Yok
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <a href="<?php echo e(url("backend.client.product.detail", ["slug" => $product->slug])); ?>">
                                                        <?php $__currentLoopData = $product->getImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($image->rank == 0): ?>
                                                                <img src="<?php echo e($image->image); ?>" alt=""
                                                                     style="height: 200px"
                                                                     class="img-fluid mx-auto d-block">
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </a>
                                                </div>

                                                <div class="text-center product-content p-4">

                                                    <h5 class="mb-1"><a
                                                                href="<?php echo e(url("backend.client.product.detail", ["slug" => $product->slug])); ?>"
                                                                class="text-dark"><?php echo e($product->title); ?></a>
                                                    </h5>
                                                    <p class="text-muted font-size-13"><?php echo e($product->getCategory->title); ?></p>

                                                    <?php if($authUser->show_price == "1"): ?>
                                                        <?php if($product->discount_rate == 0): ?>
                                                            <h5 class="mt-3 mb-0">
                                                                <?php echo e(numberFormat($product->real_price / $_SESSION["currencyValue"])); ?><?php echo e($_SESSION["currencyIcon"]); ?>

                                                            </h5>
                                                        <?php else: ?>
                                                            <h5 class="mt-3 mb-0">
                                                                <span class="text-muted me-2"><del><?php echo e(numberFormat($product->real_price / $_SESSION["currencyValue"])); ?><?php echo e($_SESSION["currencyIcon"]); ?></del></span>
                                                                <?php echo e(numberFormat($product->discounted_price / $_SESSION["currencyValue"])); ?><?php echo e($_SESSION["currencyIcon"]); ?>

                                                            </h5>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if($product->otherProducts->count() > 0): ?>
                                                        <ul class="list-inline mb-0 text-muted product-color">
                                                            <li class="list-inline-item">
                                                                Renkler :
                                                            </li>
                                                            <?php $__currentLoopData = $product->otherProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $otherProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle"
                                                                       style="color: <?php echo e($otherProduct->color); ?>;"></i>
                                                                </li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <!-- end row -->

                                <div class="row mt-4">
                                    <?php if($pagination["page"] != 1): ?>
                                        <div class="col-sm-6">
                                            <div>
                                                <p class="mb-sm-0"><?php echo e($pagination["page"]); ?>.Sayfa</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <?php else: ?>
                                                <div class="col-sm-12">
                                                    <?php endif; ?>
                                                    <div class="float-sm-end">
                                                        <ul class="pagination pagination-rounded mb-sm-0">

                                                            <?php if($pagination["page"] != 1): ?>
                                                                <li class="page-item">
                                                                    <a href="<?php echo e(url("backend.client.search.results", ["slug" => $slug, "page" => "1"])); ?>"
                                                                       class="page-link">İlk</a>
                                                                </li>
                                                            <?php endif; ?>

                                                            <?php for($i = $pagination["page"] - $pagination["forlimit"]; $i < $pagination["page"] + $pagination["forlimit"] + 1; $i++): ?>

                                                                <?php if($i > 0 && $i <= $pagination["pageCount"]): ?>

                                                                    <?php if($i == $pagination["page"]): ?>

                                                                        <li class="page-item active">
                                                                            <a href="javascript:void(0);"
                                                                               class="page-link"> <?php echo e($i); ?></a>
                                                                        </li>

                                                                    <?php else: ?>

                                                                        <li class="page-item">
                                                                            <a href="<?php echo e(url("backend.client.search.results", ["slug" => $slug, "page" => $i])); ?>"
                                                                               class="page-link"><?php echo e($i); ?></a>
                                                                        </li>

                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            <?php endfor; ?>

                                                            <?php if($pagination["page"] != $pagination["pageCount"]): ?>

                                                                <li class="page-item">
                                                                    <a href="<?php echo e(url("backend.client.search.results", ["slug" => $slug, "page" => $pagination["pageCount"]])); ?>"
                                                                       class="page-link">Son</a>
                                                                </li>
                                                            <?php endif; ?>

                                                        </ul>
                                                    </div>
                                                </div>
                                        </div>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php else: ?>
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div>
                                                <h3 class="text-center mt-3 mb-3">Ürün Bulunamadı!</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>





<?php echo $__env->make("backend.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/httpdaff/tekstil-demo.yasingokhanerdogan.com/resources/views/backend/clientArea/search/index.blade.php ENDPATH**/ ?>