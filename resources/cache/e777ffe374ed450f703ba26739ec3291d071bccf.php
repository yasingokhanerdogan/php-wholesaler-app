<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive mb-4">
            <table class="table table-centered datatable dt-responsive nowrap table-card-list"
                   style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                <thead>
                <tr class="bg-transparent">
                    <th>#</th>
                    <th>Banka</th>
                    <th>Hesap Sahibi</th>
                    <th>IBAN</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($account->id); ?></td>
                        <td><?php echo e($account->bank_name); ?></td>
                        <td><?php echo e($account->account_owner); ?></td>
                        <td><?php echo e($account->iban); ?></td>
                        <td>
                            <button type="button" onclick="location.href='<?php echo e(url("backend.admin.bank.account.edit", ["id" => $account->id])); ?>'" class="px-3 text-primary bg-soft-info rounded-1 border-0"><i class="uil uil-edit font-size-18"></i></button>
                            <button type="button" id="deleteAccount" account-id="<?php echo e($account->id); ?>" class="px-3 text-white bg-danger rounded-1 border-0"><i class="uil uil-trash-alt font-size-18"></i></button>
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
<script src="/public/backend-assets/js/pages/ecommerce-datatables.init.js"></script><?php /**PATH /home/httpdaff/tekstil-demo.yasingokhanerdogan.com/resources/views/backend/adminArea/bank-accounts/accountsArea.blade.php ENDPATH**/ ?>