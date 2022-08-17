<?php
    $authUser = \App\Models\UserModel::find($_SESSION["user"]["id"]);
    $cartCount = \App\Models\CartModel::where("user_id", $_SESSION["user"]["id"])->get()->count();
    $settings = \App\Models\SettingModel::find(0);
?>

<?php $__env->startSection("title", "Sıkça Sorulan Sorular | $settings->title"); ?>
<?php $__env->startSection("content"); ?>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Sıkça Sorulan Sorular</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Panel</li>
                                <li class="breadcrumb-item active">Sıkça Sorulan Sorular</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

           <div class="row">
               <div class="col-xl-12">
                   <div class="card">
                       <div class="card-body">
                           <div class="accordion" id="accordion">
                               <?php $faqRank = 1; ?>
                               <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <div class="accordion-item">
                                       <h2 class="accordion-header" id="heading-<?php echo e($faqRank); ?>">
                                           <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo e($faqRank); ?>" aria-expanded="false" aria-controls="collapse-<?php echo e($faqRank); ?>">
                                               <?php echo e($faqRank . ". " . $faq->question); ?>

                                           </button>
                                       </h2>
                                       <div id="collapse-<?php echo e($faqRank); ?>" class="accordion-collapse collapse" aria-labelledby="heading-<?php echo e($faqRank); ?>" data-bs-parent="#accordion" style="">
                                           <div class="accordion-body">
                                               <?php echo $faq->answer; ?>

                                           </div>
                                       </div>
                                   </div>

                                   <?php $faqRank++; ?>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </div>


                       </div>
                   </div>
               </div>
           </div>

        </div> <!-- container-fluid -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("backend.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/httpdaff/tekstil-demo.yasingokhanerdogan.com/resources/views/backend/clientArea/faqs/index.blade.php ENDPATH**/ ?>