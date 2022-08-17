<div class="table-responsive mb-4">
    <table class="table table-centered datatable dt-responsive nowrap table-card-list"
           style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
        <thead>
        <tr>
            <th>ID</th>
            <th>Ürün Adı</th>
            <th>Ürün Kodu</th>
            <th>Kategori</th>
            <th>İndirimli Satış Fiyatı</th>
            <th>Ürün Stok</th>
            <th>Ürün Renk</th>
            <th>İşlemler</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <tr>
                <td><?php echo e($product->id); ?></td>
                <td><?php echo e($product->title); ?></td>
                <td>#<?php echo e($product->product_code); ?></td>
                <td><?php echo e($product->getCategory->title); ?></td>
                <td><?php echo e(numberFormat($product->discounted_price)); ?>₺</td>
                <td>
                    <?php if($product->stock == 0): ?>
                        <span class="badge bg-danger">Bulunmuyor!</span>
                    <?php else: ?>
                        <?php echo e($product->stock); ?> m2
                    <?php endif; ?>
                </td>
                <td>
                    <div class="avatar-sm mx-auto rounded my-2"
                         style="background-color: <?php echo e($product->color); ?>"></div>
                </td>
                <td>
                    <a href="<?php echo e(url("backend.admin.product.edit", ["id" => $product->id])); ?>" class="px-3 text-primary"><i class="uil uil-pen"></i></a>
                    <a href="javascript:void(0);" product-id="<?php echo e($product->id); ?>" class="px-3 text-danger deleteProductButton"><i class="uil uil-trash-alt"></i></a>
                </td>
            </tr>

        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="/public/backend-assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
<script src="/public/backend-assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="/public/backend-assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="/public/backend-assets/js/pages/ecommerce-cart.init.js"></script>
<script src="/public/backend-assets/js/pages/ecommerce-datatables.init.js"></script><?php /**PATH /home/httpdaff/tekstil-demo.yasingokhanerdogan.com/resources/views/backend/adminArea/products/productArea.blade.php ENDPATH**/ ?>