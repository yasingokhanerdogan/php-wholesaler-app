<?php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $cartCount = \App\Models\CartModel::where("user_id", $_SESSION["user"]["id"])->get()->count();
    $settings = \App\Models\SettingModel::find(0);
?>

<?php $__env->startSection("title", "Checkout | $settings->title"); ?>
<?php $__env->startSection("content"); ?>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Checkout</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Panel</a></li>
                                <li class="breadcrumb-item active">Checkout</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-7">
                    <div class="custom-accordion">
                        <div class="card">
                            <a href="#checkout-billinginfo-collapse" class="text-dark" data-bs-toggle="collapse">
                                <div class="p-4">

                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="uil uil-receipt text-primary h2"></i>
                                        </div>
                                        <div class="flex-1 overflow-hidden">
                                            <h5 class="font-size-16 mb-1">Fatura Bilgileri</h5>
                                        </div>
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>

                                </div>
                            </a>

                            <div id="checkout-billinginfo-collapse" class="collapse show">
                                <div class="p-4 border-top">
                                    <form>
                                        <div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3 mb-4">
                                                        <label class="form-label" for="billing-name">Ad Soyad</label>
                                                        <input type="text" class="form-control" id="billing-name"
                                                               placeholder="Ad Soyad"
                                                               value="<?php echo e($authUser->name. " " .$authUser->surname); ?>"
                                                               disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3 mb-4">
                                                        <label class="form-label" for="billing-email-address">Email
                                                            Adresi</label>
                                                        <input type="email" class="form-control"
                                                               id="billing-email-address" placeholder="Email Adresi"
                                                               value="<?php echo e($authUser->email); ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3 mb-4">
                                                        <label class="form-label" for="billing-phone">Telefon</label>
                                                        <input type="text" class="form-control" id="billing-phone"
                                                               placeholder="Telefon" value="<?php echo e($authUser->phone); ?>"
                                                               disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3 mb-4">
                                                        <label class="form-label" for="billing-company-name">Şirket
                                                            Adı</label>
                                                        <input type="text" class="form-control"
                                                               id="billing-company-name"
                                                               placeholder="Şirket Adı"
                                                               value="<?php echo e($authUser->company_name); ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3 mb-4">
                                                        <label class="form-label" for="billing-identity-number">TC
                                                            Kimlik
                                                            Numarası</label>
                                                        <input type="text" class="form-control"
                                                               id="billing-identity-number" placeholder="Tc Kimlik no"
                                                               value="<?php echo e($authUser->identity_number); ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3 mb-4">
                                                        <label class="form-label" for="billing-tax-number">Vergi
                                                            Numarası</label>
                                                        <input type="email" class="form-control" id="billing-tax-number"
                                                               placeholder="Vergi Numarası"
                                                               value="<?php echo e($authUser->tax_number); ?>" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3 mb-4">
                                                        <label class="form-label" for="billing-city">Şehir</label>
                                                        <input type="text" class="form-control" id="billing-city"
                                                               placeholder="Şirket Adı"
                                                               value="<?php echo e($authUser->city); ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3 mb-4">
                                                        <label class="form-label" for="billing-zip-code">Posta
                                                            Kodu</label>
                                                        <input type="text" class="form-control"
                                                               id="billing-zip-code" placeholder="Posta Kodu"
                                                               value="<?php echo e($authUser->zip_code); ?>" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <a href="#checkout-shippinginfo-collapse" class="text-dark"
                               data-bs-toggle="collapse">
                                <div class="p-4">

                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="uil uil-truck text-primary h2"></i>
                                        </div>
                                        <div class="flex-1 overflow-hidden">
                                            <h5 class="font-size-16 mb-1">Alıcı Adres Bilgileri</h5>
                                        </div>
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>

                                </div>
                            </a>

                            <div id="checkout-shippinginfo-collapse" class="collapse show">
                                <div class="p-4 border-top">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12">
                                            <div class="card border rounded active shipping-address">
                                                <div class="card-body">
                                                    <h5 class="font-size-14"><?php echo e($authUser->name. " " .$authUser->surname); ?></h5>
                                                    <p class="mb-1"><?php echo e($authUser->address . " " . $authUser->city . " " . $authUser->zip_code); ?></p>
                                                    <p class="mb-0"><?php echo e($authUser->phone); ?></p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row my-4">
                        <div class="col">
                            <a href="<?php echo e(url("backend.client.products")); ?>" class="btn btn-link text-muted">
                                <i class="uil uil-arrow-left me-1"></i> Alışverişe Devam Et </a>
                        </div> <!-- end col -->
                    </div> <!-- end row-->
                </div>

                <div class="col-xl-5">
                    <div class="card checkout-order-summary">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-centered mb-0 table-nowrap">
                                    <thead>
                                    <tr>
                                        <th class="border-top-0" style="width: 110px;" scope="col">#</th>
                                        <th class="border-top-0" scope="col">Ürün Adı</th>
                                        <th class="border-top-0" scope="col">Fiyat</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row">
                                            <img src="<?php echo e($item->getProductImages[0]->image); ?>" alt="product-img" title="product-img" class="avatar-md">
                                        </th>
                                        <td>
                                            <h5 class="font-size-14 text-truncate">
                                                <a href="<?php echo e(url("backend.client.product.detail", ["slug" => $item->getProduct->slug])); ?>" class="text-dark"><?php echo e($item->getProduct->title); ?></a>
                                            </h5>
                                            <p class="text-muted mb-0"><?php echo e(numberFormat($item->getProduct->discounted_price) . "₺ x " . $item->product_amount); ?> m2</p>
                                        </td>
                                        <td><?php echo e(numberFormat($item->getProduct->discounted_price * $item->product_amount)); ?>₺</td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td colspan="2">
                                            <h5 class="font-size-14 m-0">Ara Toplam :</h5>
                                        </td>
                                        <td>
                                            <?php echo e(numberFormat($paymentInfo["sub_total"])); ?>₺
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h5 class="font-size-14 m-0">İndirim :</h5>
                                        </td>
                                        <td>
                                            - <?php echo e(numberFormat($paymentInfo["total_discount"])); ?>₺
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <h5 class="font-size-14 m-0">Kargo :</h5>
                                        </td>
                                        <td>
                                            Alıcı Ödemeli
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h5 class="font-size-14 m-0">Vergi(18%) :</h5>
                                        </td>
                                        <td>
                                            <?php echo e(numberFormat($paymentInfo["tax_total"])); ?>₺
                                        </td>
                                    </tr>

                                    <tr class="bg-light">
                                        <td colspan="2">
                                            <h5 class="font-size-14 m-0">Genel Toplam:</h5>
                                        </td>
                                        <td>
                                            <span style="font-weight: bold;"><?php echo e(numberFormat($paymentInfo["total"])); ?>₺</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col">
                            <div class="text-sm-start mt-2 mt-sm-0">
                                <button type="button" onclick="location.href='<?php echo e(url("backend.client.cart")); ?>'" class="btn btn-warning">
                                    <i class="uil uil-shopping-cart-alt me-1"></i> Sepete Geri Dön</button>
                            </div>
                        </div> <!-- end col -->
                        <div class="col">
                            <div class="text-sm-end mt-2 mt-sm-0">
                                <button type="button" id="checkoutOrder" class="btn btn-success">
                                    <i class="uil uil-paypal me-1"></i> Sipariş Ver</button>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row-->
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("backend.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/httpdaff/tekstil-demo.yasingokhanerdogan.com/resources/views/backend/clientArea/cart/checkout.blade.php ENDPATH**/ ?>