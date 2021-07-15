<section class="padding-bottom footerfix section-content order1">
    <a href="#" id="scroll"><span></span></a>
    <nav aria-label="breadcrumb" class="mt-5">
        <ol class="breadcrumb">
            <li class=" item-1"></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('my-account')); ?>"><?php echo e(__('msg.my_account')); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('msg.orders')); ?></li>
        </ol>
    </nav>
    <div class="container mt-5">
        <div class="row">
            <?php echo $__env->make("themes.".get('theme').".user.order-sidebar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="col-md-9">
                <?php if(isset($data['list']) && isset($data['list']['data']) && count($data['list']['data'])): ?>
                    <?php $__currentLoopData = $data['list']['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(isset($w->items) && is_array($w->items) && count($w->items)): ?>
                            <?php $__currentLoopData = $w->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($itm->id) && intval($itm->id)): ?>
                                    <div class="card shadow mb-4">
                                        <div class="row mt-2 mb-0">
                                            <div class="ml-2 form-group col">
                                                <span class="text-dark product-name"><?php echo e(__('msg.ordered_id')); ?> : <?php echo e($itm->order_id ?? '-'); ?></span><br>
                                                <span class="text-dark product-name"><?php echo e(__('msg.order_date')); ?> :  <?php echo e(isset($itm->date_added) ? date('d-m-Y', strtotime($itm->date_added)) : ''); ?></span>
                                            </div>
                                            <div class="form-group orderview-details">
                                                <div class="wallet-header">
                                                    <a href="<?php echo e(route('order-track-item', $w->id ?? 0)); ?>"><button class="btn btn-sm btn-primary"><?php echo e(__('msg.view_details')); ?></button></a>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row no-gutters">


                                                     <img class=" fav-image text-left" src="<?php echo e($itm->image); ?>" alt="<?php echo e($itm->name ?? 'Product Image'); ?>">



                                                <div class="card-body">
                                                    <a href="#" class="card-title text-dark"><?php echo e($itm->name); ?></a>
                                                    <p class="small text-muted mb-0">Qty : <?php echo e($itm->quantity); ?></p>
                                                    <p class="card-text mb-0">
                                                        <span class="font-weight-bold text-dark"><?php echo e(__('msg.Rs')); ?><?php echo e(get_price($itm->sub_total)); ?></span>
                                                    </p>
                                                    <small class="text-primary font-weight-bold">
                                                         <?php echo e(__('msg.via')); ?> <?php echo e(strtoupper($w->payment_method)); ?>

                                                    </small>
                                                    <p>
                                                        <span class="text-muted font-weight-bold"><?php echo e(strtoupper($itm->active_status)); ?></span>
                                                    </p>
                                                </div>

                                        </div>
                                    </div>
                                    <?php if(count($itm->status)): ?>
                                        <?php
                                        $orderPlaced = "";
                                        $orderProcessed = "";
                                        $orderShipped = "";
                                        $orderDelivered = "";
                                        $orderCancelled = "";
                                        $orderReturned = "";
                                        foreach($itm->status as $s){
                                            if($s[0] == "received"){
                                                $orderPlaced = $s[1];
                                            }elseif($s[0] == "processed"){
                                                $orderProcessed = $s[1];
                                            }elseif($s[0] == "shipped"){
                                                $orderShipped = $s[1];
                                            }elseif($s[0] == "delivered"){
                                                $orderDelivered = $s[1];
                                            }elseif($s[0] == "cancelled"){
                                                $orderCancelled = $s[1];
                                            }elseif($s[0] == "returned"){
                                                $orderReturned = $s[1];
                                            }
                                        }
                                        ?>
                                        <div class="card shadow mb-4">
                                            <div class="card-body">
                                                <div class="row bs-wizard">
                                                    <?php if($orderPlaced != ""): ?>
                                                        <div class="col-3 col-md-3 bs-wizard-step complete">
                                                            <div class="text-center bs-wizard-stepnum text-muted"><?php echo e(__('msg.order_placed')); ?></div>
                                                            <div class="progress"><div class="progress-bar"></div></div>
                                                            <a href="#" class="bs-wizard-dot activeStep"></a>
                                                            <div class="bs-wizard-info text-center text-muted"><?php echo e(date("d-m-Y", strtotime($orderPlaced))); ?></div>
                                                            <div class="bs-wizard-info text-center text-muted"><?php echo e(date('h:i:s A', strtotime($orderPlaced))); ?></div>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if($orderProcessed != ""): ?>
                                                        <div class="col-3 col-md-3 bs-wizard-step complete">
                                                            <div class="text-center bs-wizard-stepnum text-muted"><?php echo e(__('msg.order_processed')); ?></div>
                                                            <div class="progress"><div class="progress-bar"></div></div>
                                                            <a href="#" class="bs-wizard-dot activeStep"></a>
                                                            <div class="bs-wizard-info text-center text-muted"><?php echo e(date("d-m-Y", strtotime($orderProcessed))); ?></div>
                                                            <div class="bs-wizard-info text-center text-muted"><?php echo e(date("h:i:s A", strtotime($orderProcessed))); ?></div>
                                                        </div>
                                                    <?php elseif($orderCancelled == ""): ?>
                                                        <div class="col-3 col-md-3 bs-wizard-step disabled">
                                                            <div class="text-center bs-wizard-stepnum text-muted"><?php echo e(__('msg.order_processed')); ?></div>
                                                            <div class="progress"><div class="progress-bar"></div></div>
                                                            <a href="#" class="bs-wizard-dot"></a>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if($orderShipped != ""): ?>
                                                        <div class="col-3 col-md-3 bs-wizard-step complete">
                                                            <div class="text-center bs-wizard-stepnum text-muted"><?php echo e(__('msg.order_shipped')); ?></div>
                                                            <div class="progress"><div class="progress-bar"></div></div>
                                                            <a href="#" class="bs-wizard-dot activeStep"></a>
                                                            <div class="bs-wizard-info text-center text-muted"><?php echo e(date("d-m-Y", strtotime($orderShipped))); ?></div>
                                                            <div class="bs-wizard-info text-center text-muted"><?php echo e(date("h:i:s A", strtotime($orderShipped))); ?></div>
                                                        </div>
                                                    <?php elseif($orderCancelled == ""): ?>
                                                        <div class="col-3 col-md-3 bs-wizard-step disabled">
                                                            <div class="text-center bs-wizard-stepnum text-muted"><?php echo e(__('msg.order_shipped')); ?></div>
                                                            <div class="progress"><div class="progress-bar"></div></div>
                                                            <a href="#" class="bs-wizard-dot"></a>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if($orderDelivered != ""): ?>
                                                        <div class="col-3 col-md-3 bs-wizard-step complete">
                                                            <div class="text-center bs-wizard-stepnum text-muted"><?php echo e(__('msg.order_delivered')); ?></div>
                                                            <div class="progress"><div class="progress-bar"></div></div>
                                                            <a href="#" class="bs-wizard-dot activeStep"></a>
                                                            <div class="bs-wizard-info text-center text-muted"><?php echo e(date("d-m-Y", strtotime($orderDelivered))); ?></div>
                                                            <div class="bs-wizard-info text-center text-muted"><?php echo e(date("h:i:s A", strtotime($orderDelivered))); ?></div>
                                                        </div>
                                                    <?php elseif($orderCancelled == ""): ?>
                                                        <div class="col-3 col-md-3 bs-wizard-step disabled">
                                                            <div class="text-center bs-wizard-stepnum text-muted"><?php echo e(__('msg.order_delivered')); ?></div>
                                                            <div class="progress"><div class="progress-bar"></div></div>
                                                            <a href="#" class="bs-wizard-dot"></a>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if($orderCancelled != ""): ?>
                                                        <div class="col-3 col-md-3 bs-wizard-step complete">
                                                            <div class="text-center bs-wizard-stepnum text-muted"><?php echo e(__('msg.order_cancelled')); ?></div>
                                                            <div class="progress"><div class="progress-bar"></div></div>
                                                            <a href="#" class="bs-wizard-dot activeStep"></a>
                                                            <div class="bs-wizard-info text-center text-muted"><?php echo e(date("d-m-Y", strtotime($orderCancelled))); ?></div>
                                                            <div class="bs-wizard-info text-center text-muted"><?php echo e(date("h:i:s A", strtotime($orderCancelled))); ?></div>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if($itm->applied_for_return == true): ?>
                                                        <?php if($orderReturned != ""): ?>
                                                            <div class="col-3 col-md-3 bs-wizard-step complete">
                                                                <div class="text-center bs-wizard-stepnum text-muted"><?php echo e(__('msg.order_returned')); ?></div>
                                                                <div class="progress"><div class="progress-bar"></div></div>
                                                                <a href="#" class="bs-wizard-dot activeStep"></a>
                                                                <div class="bs-wizard-info text-center text-muted"><?php echo e(date("d-m-Y", strtotime($orderReturned))); ?></div>
                                                                <div class="bs-wizard-info text-center text-muted"><?php echo e(date("h:i:s A", strtotime($orderReturned))); ?></div>
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="col-3 col-md-3 bs-wizard-step disabled">
                                                                <div class="text-center bs-wizard-stepnum text-muted"><?php echo e(__('msg.order_returned')); ?></div>
                                                                <div class="progress"><div class="progress-bar"></div></div>
                                                                <a href="#" class="bs-wizard-dot"></a>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="row text-center">
                        <div class="col-12">
                            <br><br>
                            <h3><?php echo e(__('msg.no_orders_found')); ?>.</h3>
                        </div>
                        <div class="col-12">
                            <br><br>
                            <a href="<?php echo e(route('shop')); ?>" class="btn btn-primary"><em class="fa fa-chevron-left mr-1"></em> <?php echo e(__('msg.continue_shopping')); ?></a>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col">
                        <?php if(isset($data['last']) && $data['last'] != ""): ?>
                            <a href="<?php echo e($data['last']); ?>" class="btn btn-primary pull-left text-white"><em class="fa fa-arrow-left"></em> <?php echo e(__('msg.previous')); ?></a>
                    </div></a>
                        <?php endif; ?>

                    <div class="col text-right">
                        <?php if(isset($data['next']) && $data['next'] != ""): ?>
                            <a href="<?php echo e($data['next']); ?>" class="btn btn-primary pull-right text-white"><?php echo e(__('msg.next')); ?><em class="ml-2 fa fa-arrow-right"></em></a>
                    </div>
                        <?php endif; ?>
                </div>
                </div>
            </div>
        </div>
</section>
<?php /**PATH /home/thetricu/marvel.niktechsolution.com/resources/views/themes/ekart/user/orders.blade.php ENDPATH**/ ?>