<div class="row" id="controlled_orders">
    <div class="col-lg-12">
        <div class="table-responsive mb-4">
            <table class="table table-centered datatable dt-responsive nowrap table-card-list"
                   style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                <thead>
                <tr class="bg-transparent">
                    <th>Sipariş No</th>
                    <th>Kul. ID</th>
                    <th>Miktar</th>
                    <th>İndirimli Fiyat</th>
                    <th>Ödenecek Tutar</th>
                    <th>Son Ödeme Tarihi</th>
                    <th>Sipariş Durumu</th>
                    <th style="width: 120px;">İşlemler</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $controlled_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <a href="javascript: void(0);" class="text-dark fw-bold">#<?php echo e($order->order_no); ?></a>
                        </td>
                        <td><?php echo e($order->user_id); ?></td>
                        <td><?php echo e($order->total_product_amount); ?> m2</td>
                        <td><?php echo e(numberFormat($order->total_discounted_price)); ?>₺</td>
                        <td><?php echo e(numberFormat($order->total_price)); ?>₺</td>
                        <td><?php echo e($order->created_at->modify("+1 day")); ?></td>
                        <td id="tooltip-container">
                            <?php if($order->status == "controlled"): ?>
                                <button type="button" class="border-0 badge bg-pill bg-soft-success font-size-12">Ödeme Kontrol Edildi!</button>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button type="button" id="confirmOrderAdmin" order-no="<?php echo e($order->order_no); ?>" class="px-3 text-white bg-success rounded-1 border-0"><i class="uil uil-check font-size-18"></i></button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <!-- end table -->
    </div>
</div>

<script src="/public/backend-assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
<script src="/public/backend-assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="/public/backend-assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="/public/backend-assets/js/pages/ecommerce-cart.init.js"></script>
<script src="/public/backend-assets/js/pages/ecommerce-datatables.init.js"></script><?php /**PATH /home/httpdaff/tekstil-demo.yasingokhanerdogan.com/resources/views/backend/adminArea/orders/controlledArea.blade.php ENDPATH**/ ?>