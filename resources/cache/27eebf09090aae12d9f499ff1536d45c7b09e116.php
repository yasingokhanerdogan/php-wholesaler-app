<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive mb-4">
            <table class="table table-centered datatable dt-responsive nowrap table-card-list"
                   style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                <thead>
                <tr class="bg-transparent">
                    <th>Sipariş No</th>
                    <th>Miktar</th>
                    <th>İndirim</th>
                    <th>İndirimli Fiyat</th>
                    <th>Ödenecek Tutar</th>
                    <th>Son Ödeme Tarihi</th>
                    <th>Sipariş Durumu</th>
                    <th style="width: 120px;">İşlemler</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <a href="javascript: void(0);" class="text-dark fw-bold">#<?php echo e($order->order_no); ?></a>
                        </td>
                        <td><?php echo e($order->total_product_amount); ?> m2</td>
                        <td><?php echo e(numberFormat($order->total_discount)); ?>₺</td>
                        <td><?php echo e(numberFormat($order->total_discounted_price)); ?>₺</td>
                        <td><?php echo e(numberFormat($order->total_price)); ?>₺</td>
                        <td><?php echo e($order->created_at->modify("+1 day")); ?></td>
                        <td id="tooltip-container">
                            <?php if($order->status == "pending"): ?>
                                <button type="button" class="border-0 badge bg-pill bg-soft-warning font-size-12">Ödeme Bekleniyor!</button>
                            <?php elseif($order->status == "approved"): ?>
                                <button type="button" class="border-0 badge bg-pill bg-soft-success font-size-12">Sipariş Onaylandı!</button>
                            <?php elseif($order->status == "paid"): ?>
                                <button type="button" class="border-0 badge bg-pill bg-soft-warning font-size-12">Ödeme Bildirimi Yapıldı!</button>
                            <?php elseif($order->status == "canceled"): ?>
                                <button type="button" class="border-0 badge bg-pill bg-soft-danger font-size-12">İptal Edildi!</button>
                            <?php elseif($order->status == "controlled"): ?>
                                <button type="button" class="border-0 badge bg-pill bg-soft-success font-size-12">Ödeme Kontrol Edildi!</button>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button type="button" onclick="location.href='<?php echo e(url("backend.client.order.invoice", ["orderNo" => $order->order_no])); ?>'" class="px-3 text-primary bg-soft-info rounded-1 border-0"><i class="uil uil-eye font-size-18"></i></button>
                            <?php if($order->status == "pending" && $order->status_description == "0"): ?>
                                <button type="button" title="İptal Et" id="cancelOrder" order-no="<?php echo e($order->order_no); ?>" class="px-3 text-white bg-danger rounded-1 border-0"><i class="uil uil-trash-alt font-size-18"></i></button>
                            <?php endif; ?>
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
<script src="/public/backend-assets/js/pages/ecommerce-datatables.init.js"></script>

<script src="/public/backend-assets/js/app.js"></script><?php /**PATH /home/httpdaff/tekstil-demo.yasingokhanerdogan.com/resources/views/backend/clientArea/orders/orderArea.blade.php ENDPATH**/ ?>