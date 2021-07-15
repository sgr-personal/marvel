<?php echo $__env->make("themes.$theme.common.msg", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="section-content footerfix padding-bottom">
    <a href="#" id="scroll"><span></span></a>
    <div class="container mt-5">
        <h2 class="mb-5 title-sec text-center"><?php echo e(__('msg.shopping_cart')); ?></h2>
        <?php if(Cache::has('min_order_amount') && intval($data['subtotal']) <= intval(Cache::get('min_order_amount'))): ?>
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="alert alert-warning"><?php echo e(__('msg.you_must_have_to_purchase')); ?> <?php echo e(get_price(Cache::get('min_order_amount'))); ?> <?php echo e(__('msg.to_place_order')); ?></div>
                </div>
            </div>
        <?php elseif(intval(Cache::get('min_amount', 0)) && intval($data['shipping'])): ?>
            <?php if(intval($data['subtotal']) && intval($data['subtotal']) < Cache::get('min_amount')): ?>
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="alert alert-info"><?php echo e(__('msg.you_can_get_free_delivery_by_shopping_more_than')); ?> <?php echo e(get_price(Cache::get('min_amount'))); ?></div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <div class="row justify-content-center">
            <main class="col-md-9">
                <div class="card">
                    <div class="table-responsive">
                        <table id="myTable" class="table ">
                            <thead>
                                <tr class="cart1title">
                                    <th scope="col"><?php echo e(__('msg.product')); ?></th>
                                    <th scope="col"><?php echo e(__('msg.qty')); ?></th>
                                    <th scope="col"><?php echo e(__('msg.price')); ?></th>
                                    <th scope="col" class="text-right cartext"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($data['cart']) && is_array($data['cart']) && count($data['cart'])): ?>
                                    <?php $__currentLoopData = $data['cart']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(isset($p->item[0])): ?>
                                            <tr class="cart1price">
                                                <td>
                                                    <a href="<?php echo e(route('product-single', $p->item[0]->slug)); ?>">
                                                        <figure class="itemside">
                                                            <div class="aside">
                                                                <img src="<?php echo e($p->item[0]->image); ?>" class="img-sm" alt="<?php echo e($p->item[0]->name ?? 'Product Image'); ?>">
                                                            </div>
                                                            <figcaption class="info">
                                                                <a href="<?php echo e(route('product-single', $p->item[0]->slug)); ?>" class="title text-dark"><?php echo e($p->item[0]->name ?? '-'); ?></a>
                                                                <p class="small text-muted"><?php echo e(get_varient_name($p->item[0]) ?? '-'); ?></p>
                                                            </figcaption>
                                                        </figure>
                                                    </a>
                                                </td>
                                                <td class="cart">
                                                    <div class="price-wrap cartShow"><?php echo e($p->qty); ?></div>
                                                    <form action="<?php echo e(route('cart-update', $p->product_id)); ?>" method="POST" class="cartEdit">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="child_id" value="<?php echo e($p->product_variant_id); ?>">
                                                        <input type="hidden" name="product_id" value="<?php echo e($p->product_id); ?>">
                                                        <div class="button-container col">
                                                            <button class="cart-qty-minus button-minus" type="button" id="button-minus" value="-">-</button>
                                                            <input class="form-control qtyPicker" type="number" name="qty" data-min="1" min="1" max="<?php echo e(intval(getMaxQty($p->item[0]))); ?>" data-max="<?php echo e(intval(getMaxQty($p->item[0]))); ?>" value="<?php echo e($p->qty); ?>" readonly>
                                                            <button class="cart-qty-plus button-plus" type="button" id="button-plus" value="+">+</button>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td>
                                                    <div class="price-wrap">
                                                        <var class="price">
                                                            <?php if(intval($p->item[0]->discounted_price)): ?>
                                                                <?php echo e(get_price($p->item[0]->discounted_price * ($p->qty ?? 1) )); ?>

                                                            <?php else: ?>
                                                                <?php echo e(get_price($p->item[0]->price * ($p->qty ?? 1) )); ?>

                                                            <?php endif; ?>
                                                        </var>
                                                        <?php if(intval($p->qty) > 1): ?>
                                                            <?php if(intval($p->item[0]->discounted_price)): ?>
                                                                <br><small class="text-muted"> <?php echo e(get_price($p->item[0]->discounted_price)); ?><?php echo e(($p->qty > 0) ? ' each' : ''); ?></small>
                                                            <?php else: ?>
                                                                <br><small class="text-muted"> <?php echo e(get_price($p->item[0]->price)); ?><?php echo e(($p->qty > 0) ? ' each' : ''); ?></small>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td class="text-right checktrash">
                                                    <button class="btn btn-light btn-round btnEdit cartShow"> <em class="fa fa-pencil-alt"></em></button>
                                                    <button class="btn btn-light btn-round cartSave cartEdit"> <em class="fas fa-check"></em></button>
                                                    <button class="btn btn-light btn-round btnEdit cartEdit"> <em class="fa fa-times"></em></button>
                                                    <a href="<?php echo e(route('cart-remove', $p->product_variant_id )); ?>" class="btn btn-light btn-round"> <em class="fas fa-trash-alt"></em></a>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <img src="<?php echo e(asset('images/empty-cart.png')); ?>" alt="No Items In Cart">
                                        <br><br>
                                        <a href="<?php echo e(route('shop')); ?>" class="btn btn-primary"><em class="fa fa-chevron-left  mr-1"></em><?php echo e(__('msg.continue_shopping')); ?></a>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                            <?php if(isset($data['cart']) && is_array($data['cart']) && count($data['cart'])): ?>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td class="text-right" colspan="2">
                                            <p class="product-name"><?php echo e(__('msg.subtotal')); ?> : <span><?php echo e(get_price($data['subtotal']) ?? '-'); ?></span></p>
                                            <?php if(isset($data['tax_amount']) && floatval($data['tax_amount'])): ?>
                                                <p class="product-name"><?php echo e(__('msg.tax')); ?> <?php echo e($data['tax'] ? $data['tax']."%" : ''); ?> : <span>+ <?php echo e(get_price($data['tax_amount'])); ?></span></p>
                                            <?php endif; ?>
                                            <?php if(isset($data['shipping']) && floatval($data['shipping'])): ?>
                                                <p class="product-name"><?php echo e(__('msg.delivery_charge')); ?> : <span>+ <?php echo e(get_price($data['shipping'])); ?></span></p>
                                            <?php endif; ?>
                                            <?php if(isset($data['coupon']['discount']) && floatval($data['coupon']['discount'])): ?>
                                                <p class="product-name"><?php echo e(__('msg.discount')); ?> : <span>- <?php echo e(get_price($data['coupon']['discount'])); ?></span></p>
                                            <?php endif; ?>
                                            <p class="product-name"><?php echo e(__('msg.total')); ?> : <span> <?php echo e(get_price($data['total']) ?? '-'); ?></span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="continue-shopping"><strong><span><a href="<?php echo e(route('shop')); ?>" class="btn btn-primary"><em class="fa fa-chevron-left mr-1"></em><?php echo e(__('msg.continue_shopping')); ?></a></span></strong></td>
                                        <?php if(isset($data['cart']) && is_array($data['cart']) && count($data['cart'])): ?>
                                            <td></td>
                                            <td colspan="2" class="text-right checkoutbtn">
                                                <a href="<?php echo e(route('cart-remove', 'all' )); ?>" class="btn btn-primary"><?php echo e(__('msg.delete_all')); ?> <em class="fa fa-trash"></em></a>
                                                <?php if(Cache::has('min_order_amount') && intval($data['subtotal']) >= intval(Cache::get('min_order_amount'))): ?>
                                                    <a href="<?php echo e(route('checkout')); ?>" class="btn btn-primary"><?php echo e(__('msg.checkout')); ?> <em class="fa fa-arrow-right"></em></a>
                                                <?php else: ?>
                                                    <button class="btn btn-primary" disabled><?php echo e(__('msg.checkout')); ?> <em class="fa fa-arrow-right"></em></button>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                </tfoot>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</section><?php /**PATH /home/thetricu/marvel.niktechsolution.com/resources/views/themes/ekart/cart.blade.php ENDPATH**/ ?>