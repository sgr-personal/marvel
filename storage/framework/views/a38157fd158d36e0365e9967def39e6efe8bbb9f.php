<section class="padding-bottom footerfix section-content">
    <a href="#" id="scroll"><span></span></a>
    <div class="container mt-5">
        <?php if(isset($data['list']) && isset($data['list']['data']) && count($data['list']['data'])): ?>
            <?php $__currentLoopData = $data['list']['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="row mt-2 mb-0">
                                <div class="ml-3 form-group col idtransaction"><span class="font-weight-bold"><?php echo e(__('msg.id')); ?> #<?php echo e($w->id); ?></span></div>
                            </div>
                            <hr class="m-0">
                            <div class="m-2 ml-3">
                                <div class="row  mb-0">
                                    <div class="form-group col transamount">
                                    <span class="font-weight-bold "><?php echo e(__('msg.via')); ?> <?php echo e(strtoupper($w->type)); ?></span></div>
                                    <div class="mr-5 form-group">
                                        <div class="wallet-header">
                                            <button class="btn btn-sm btn-<?php echo e(($w->status == 'canceled') ? 'danger' : 'success'); ?>"><?php echo e(strtoupper($w->status)); ?></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="form-group col m-0">
                                        <span class="text-muted mt-0">
                                            <?php echo e(__('msg.date_and_time')); ?>

                                        </span>
                                    </div>
                                    <div class="mr-5 form-group transamount"><span class="font-weight-bold"><?php echo e(__('msg.amount')); ?> : <?php echo e(get_price($w->amount, false)); ?></span></div>
                                </div>

                                <p class="card-title product-name"><?php echo e(date('d-M-Y H:i A', strtotime($w->date_created))); ?></p>
                                <span class="text-muted mb-0"><?php echo e(__('msg.message')); ?></span>
                                <p class="text-dark mb-0">
                                    <span class="product-name"><?php echo e($w->message); ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="row text-center">
                <div class="col-12">
                    <br><br>
                    <h3><?php echo e(__('msg.no_transaction_history_found')); ?></h3>
                </div>
                <div class="col-12">
                    <br><br>
                    <a href="<?php echo e(route('shop')); ?>" class="btn btn-primary"><em class="fa fa-chevron-left mr-1"></em><?php echo e(__('msg.continue_shopping')); ?></a>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col">
                <?php if(isset($data['last']) && $data['last'] != ""): ?>
                    <a href="<?php echo e($data['last']); ?>" class="btn btn-primary pull-left text-white"><em class="fa fa-arrow-left"></em><?php echo e(__('msg.previous')); ?></a>
                <?php endif; ?>
            </div>
            <div class="col favnext text-right">
                <?php if(isset($data['next']) && $data['next'] != ""): ?>
                    <a href="<?php echo e($data['next']); ?>" class="btn btn-primary pull-right text-white"><?php echo e(__('msg.next')); ?> <em class="fa fa-arrow-right"></em></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section><?php /**PATH /home/thetricu/marvel.niktechsolution.com/resources/views/themes/ekart/user/transaction-history.blade.php ENDPATH**/ ?>