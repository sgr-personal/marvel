
<?php echo $__env->make("themes.$theme.common.msg", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="section-content footerfix padding-bottom mt-5">
    <a href="#" id="scroll"><span></span></a>
    <div class="container">
        <div class="card shadow-sm mb-4">
            <div class="row">
                <div class="col-md-4 col-4 text-center">
                    <span class="icon dark"><em class="fa fa-chevron-circle-right delivery-icon"></em> <?php echo e(__('msg.delivery')); ?></span>
                </div>
                <div class="col-md-4 col-4 text-center payment-icon">
                    <span class="icon dark"><em class="fa fa-chevron-circle-right"></em> <?php echo e(__('msg.address')); ?></span>
                </div>
                <div class="col-md-4 col-4 text-center payment-icon">
                    <span class="icon dark"><em class="fa fa-chevron-circle-right"></em> <?php echo e(__('msg.payment')); ?></span>
                </div>
            </div>
        </div>
        <main>
            <div class="row" id="delivery">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <?php if(intval($data['coupon'] ?? 0)): ?>
                                <div class="form-group" id='couponAppliedDiv'>
                                    <label class="title-sec"><?php echo e(__('msg.coupon_code')); ?></label>
                                    <div class="alert alert-success"><?php echo e($data['coupon']['promo_code_message']); ?></div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="<?php echo e($data['coupon']['promo_code']); ?>" disabled="disabled" placeholder="Coupon code">
                                        <span class="input-group-append">
                                            <a href="<?php echo e(route('coupon-remove')); ?>" class="btn btn-danger" id='removeCoupon'>x</a>
                                        </span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <form action="<?php echo e(route('coupon-apply')); ?>" method="POST" class='ajax-form <?php echo e(intval($data['coupon'] ?? 0) ? 'address-hide' : ''); ?>' id='couponForm'>
                                <input type="hidden" name="total" value="<?php echo e($data['total']); ?>">
                                <div class="form-group">
                                    <label class="title-sec"><?php echo e(__('msg.have_a_promo_code')); ?></label>
                                    <div class='formResponse'></div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="coupon" value="<?php echo e($data['coupon']['promo_code'] ?? ''); ?>" placeholder="Coupon code">
                                        <span class="input-group-append">
                                            <button class="btn btn-primary"><?php echo e(__('msg.apply')); ?></button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="summary">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="table-responsive">
                            <p class="product-name title-sec pb-0 font-weight-bold head" id="myDec"><?php echo e(__('msg.order_summary')); ?></p>
                            <table id="myTable" class="table" aria-describedby="myDec">
                                <thead>
                                    <tr class="checkout1title">
                                        <th scope="col"><?php echo e(__('msg.product')); ?></th>
                                        <th scope="col"><?php echo e(__('msg.qty')); ?></th>
                                        <th scope="col"><?php echo e(__('msg.price')); ?></th>
                                        <th scope="col"><?php echo e(__('msg.subtotal')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php if(isset($data['cart']) && is_array($data['cart']) && count($data['cart'])): ?>

                                        <?php $__currentLoopData = $data['cart']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <?php if(isset($p->item)): ?>

                                                <tr>
                                                    <td>
                                                        <a href="#">
                                                            <div class="product-img">
                                                                <figcaption class="info-wrap">
                                                                    <a href="#" class="product-name text-dark"><?php echo e(strtoupper($p->item[0]->name) ?? '-'); ?></a>
                                                                    <p class="small text-muted"><?php echo e(get_varient_name($p->item[0])); ?><br><?php echo e(__('msg.tax')." (".$p->item[0]->tax_percentage); ?>%)</p>
                                                                </figcaption>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td><?php echo e($p->qty); ?></td>
                                                    <td>
                                                        <?php if(intval($p->item[0]->discounted_price)): ?>
                                                            <?php echo e($p->item[0]->discounted_price ?? ''); ?>

                                                        <?php else: ?>
                                                            <?php echo e($p->item[0]->price ?? ''); ?>

                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if(intval($p->item[0]->discounted_price)): ?>
                                                            <?php echo e($p->item[0]->discounted_price * ($p->qty ?? 1)); ?>

                                                        <?php else: ?>
                                                            <?php echo e($p->item[0]->price * ($p->qty ?? 1)); ?>

                                                        <?php endif; ?>
                                                    </td>
                                                </tr>

                                            <?php endif; ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php endif; ?>

                                    <tfoot class="text-right">
                                        <tr class="mr-5">
                                            <td colspan="4">
                                                <p class="product-name"><?php echo e(__('msg.subtotal')); ?> : <span><?php echo e(get_price($data['subtotal'] ?? '-')); ?></span></p>
                                                <?php if(isset($data['tax_amount']) && floatval($data['tax_amount'])): ?>
                                                    <p class="product-name"><?php echo e(__('msg.tax')); ?> <?php echo e($data['tax'] ? $data['tax']."%" : ''); ?> : <span>+ <?php echo e(get_price($data['tax_amount'])); ?></span></p>
                                                <?php endif; ?>
                                                <?php if(isset($data['shipping']) && floatval($data['shipping'])): ?>
                                                    <p class="product-name"><?php echo e(__('msg.delivery_charge')); ?> : <span>+ <?php echo e(get_price($data['shipping'])); ?></span></p>
                                                <?php endif; ?>
                                                <?php if(isset($data['saved_price']) && floatval($data['saved_price'])): ?>
                                                    <p class="product-name"><?php echo e(__('msg.saved_price')); ?> : <span><?php echo e(get_price($data['saved_price'])); ?></span></p>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr class="text-left">
                                            <td>
                                                <strong>
                                                    <p class="checkout-total"><?php echo e(__('msg.total')); ?> : <span><?php echo e(get_price($data['total'])); ?></span></p>
                                                </strong>
                                            </td>

                                            <td colspan="2"></td>
                                            <td class="text-right">
                                                <strong>
                                                    <span>
                                                        <a href='<?php echo e(route('checkout-address')); ?>' class="btn btn-primary text-uppercase add-to-cart"><?php echo e(__('msg.confirm')); ?> <em class="fa fa-check"></em></a>
                                                    </span>
                                                </strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</section>
<?php /**PATH /home/thetricu/titalidesingerstudio.com/resources/views/themes/ekart/checkout_summary.blade.php ENDPATH**/ ?>