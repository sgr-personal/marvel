<section class="section-content footerfix padding-bottom mt-5 checkoutpayment">
    <a href="#" id="scroll"><span></span></a>
    <div class="container">
        <div class="card shadow-sm mb-4">
            <div class="row">
                <div class="col-md-4 col-4 text-center">
                    <a href="<?php echo e(route('checkout')); ?>"><span class="icon dark"><em class="fa fa-chevron-circle-right delivery-icon"></em> <?php echo e(__('msg.delivery')); ?></span></a>
                </div>
                <div class="col-md-4 col-4 text-center">
                    <a href="<?php echo e(route('checkout-address')); ?>"><span class="icon dark"><em class="fa fa-chevron-circle-right delivery-icon"></em> <?php echo e(__('msg.address')); ?></span></a>
                </div>
                <div class="col-md-4 col-4 text-center">
                    <span class="icon dark"><em class="fa fa-chevron-circle-right delivery-icon"></em> <?php echo e(__('msg.payment')); ?></span>
                </div>
            </div>
        </div>

        <main>
            <div>
                <!--<div class="row">
                    <div class="col-md-12" id="balance">
                        <div class="card shadow p-3 mb-4">
                            <div class="custom-control title-sec custom-checkbox mb-1">
                                <input type="checkbox" class="custom-control-input" id="wallet" data-amount='<?php echo e($data['user']['balance'] ?? '0'); ?>' />
                                <label class="custom-control-label" for="wallet"><?php echo e(__('msg.wallet_balance')); ?></label>
                            </div>
                            <small class="text-muted custom-control"><?php echo e(__('msg.total_balance')); ?>: <?php echo e(get_price($data['user']['balance'] ?? '0', false)); ?></small>
                        </div>
                    </div>
                </div>-->
                <div class="row">
                    <div class="col-md-8">
                        <?php if(isset(Cache::get('timeslot')->slots) && count(Cache::get('timeslot')->slots)): ?>
                            <div class="card shadow mb-4">
                                <h3 class="card-title title-sec ml-3 mt-3" id="myDec"><?php echo e(__('msg.select_delivery_day')); ?></h3>
                                <table class="table table-borderless table-shopping-cart" aria-describedby="myDec" aria-hidden="true">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="alert alert-danger" id="dateError"><?php echo e(__('msg.select_suitable_delivery_date')); ?></div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group calender w-100">
                                                        <div id="calendar">
                                                            <div id="datepicker" data-start='<?php echo e(Cache::get('delivery_starts_from', 0)); ?>' data-end='<?php echo e(Cache::get('allowed_days', 0)); ?>'></div>
                                                            <em class="calender-icon fa fa-calendar-o"></em> <span id='deliveryDatePrint'></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h3 class="title-sec card-title ml-3" id="myDec3"><?php echo e(__('msg.select_delivery_time')); ?></h3>
                                <table class="table table-borderless table-shopping-cart" aria-describedby="myDec3" aria-hidden="true">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="alert alert-danger" id="timeError"><?php echo e(__('select_payment_suitable_delivery_time')); ?></div>
                                                </div>
                                                <div class="form-group" id="time">
                                                    <?php $__currentLoopData = Cache::get('timeslot')->slots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($slot->status == 1): ?>
                                                            <label class="custom-control custom-radio">
                                                                <input class="custom-control-input" type="radio" name="deliverTime" value="<?php echo e($slot->title); ?>" data-from="<?php echo e($slot->from_time); ?>" data-to="<?php echo e($slot->to_time); ?>" data-last="<?php echo e($slot->last_order_time); ?>">
                                                                <span class="custom-control-label"> <?php echo e($slot->title); ?></span>
                                                            </label>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow">
                            <h3 class="card-title title-sec ml-3 mt-3" id="myDec2"><?php echo e(__('msg.payment_method')); ?></h3>
                            <table class="table table-borderless table-shopping-cart" aria-describedby="myDec2" aria-hidden="true">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <div class="alert alert-danger" id="paymentError"><?php echo e(__('msg.select_payment_method')); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <?php if(isset(Cache::get('payment_methods')->cod_payment_method) && Cache::get('payment_methods')->cod_payment_method == 1): ?>
                                                    <label class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" value="cod" name='payment_method' checked>
                                                        <span class="custom-control-label"> <?php echo e(__('msg.cash_on_delivery')); ?></span>
                                                    </label>
                                                <?php endif; ?>
                                                <?php if(isset(Cache::get('payment_methods')->paypal_payment_method) && Cache::get('payment_methods')->paypal_payment_method == 1): ?>
                                                    <label class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" value="paypal" name='payment_method'>
                                                        <span class="custom-control-label"> <?php echo e(__('msg.paypal')); ?></span>
                                                    </label>
                                                <?php endif; ?>
                                                <?php if(isset(Cache::get('payment_methods')->payumoney_payment_method) && Cache::get('payment_methods')->payumoney_payment_method == 1): ?>
                                                    <label class="custom-control custom-radio" id="PayUMoney">
                                                        <input class="custom-control-input" type="radio" value="payumoney" name='payment_method'>
                                                        <span class="custom-control-label"> <?php echo e(__('msg.PayUMoney')); ?></span>
                                                    </label>
                                                    <label class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" value="payumoney-bolt" name='payment_method'>
                                                        <span class="custom-control-label"> <?php echo e(__('msg.PayUMoney')); ?></span>
                                                    </label>
                                                <?php endif; ?>
                                                <?php if(isset(Cache::get('payment_methods')->razorpay_payment_method) && Cache::get('payment_methods')->razorpay_payment_method == 1): ?>
                                                    <label class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" value="razorpay" name='payment_method'>
                                                        <span class="custom-control-label"> <?php echo e(__('msg.Razorpay')); ?></span>
                                                    </label>
                                                <?php endif; ?>
                                                <?php if(isset(Cache::get('payment_methods')->stripe_payment_method) && Cache::get('payment_methods')->stripe_payment_method == 1): ?>
                                                    <label class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" value="stripe" name='payment_method'>
                                                        <span class="custom-control-label"> <?php echo e(__('msg.Stripe')); ?></span>
                                                    </label>
                                                <?php endif; ?>
                                                <?php if(isset(Cache::get('payment_methods')->midtrans_payment_method) && Cache::get('payment_methods')->midtrans_payment_method == 1): ?>
                                                    <label class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" value="midtrans" name='payment_method'>
                                                        <span class="custom-control-label"> <?php echo e(__('msg.Midtrans')); ?></span>
                                                    </label>
                                                <?php endif; ?>
                                                <?php if(isset(Cache::get('payment_methods')->flutterwave_payment_method) && Cache::get('payment_methods')->flutterwave_payment_method == 1): ?>
                                                    <label class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" value="flutterwave" name='payment_method'>
                                                        <span class="custom-control-label"> <?php echo e(__('msg.flutterwave')); ?></span>
                                                    </label>
                                                <?php endif; ?>
                                                <?php if(isset(Cache::get('payment_methods')->paystack_payment_method) && Cache::get('payment_methods')->paystack_payment_method == 1): ?>
                                                    <label class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" value="paystack" name='payment_method'>
                                                        <span class="custom-control-label"> <?php echo e(__('msg.paystack')); ?></span>
                                                    </label>
                                                <?php endif; ?>
                                                <?php if(isset(Cache::get('payment_methods')->paytm_payment_method) && Cache::get('payment_methods')->paytm_payment_method == 1): ?>
                                                    <label class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" value="paytm" name='payment_method'>
                                                        <span class="custom-control-label"> <?php echo e(__('msg.paytm')); ?></span>
                                                    </label>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="text-center mb-3">
                                <a role="button" data-confirm="Confirm Order Amount">
                                    <button id='proceed' class="btn btn-success text-uppercase add-to-cart">
                                        <?php echo e(__('msg.procced')); ?> <em class="fa fa-arrow-right"></em>
                                    </button>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- The Modal -->
            <div id="orderConfirm" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <?php echo e(__('msg.confirm_order_amount')); ?>

                            <div class=" mb-0 mr-4 row">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="">
                                <tr class="mr-5">
                                    <td>                               
                                        <p class="product-name"><?php echo e(__('msg.subtotal')); ?> : <span><?php echo e($data['subtotal'] ?? '-'); ?></span></p>
                                        <?php if(isset($data['tax_amount']) && floatval($data['tax_amount'])): ?>
                                            <p class="product-name"><?php echo e(__('msg.tax')); ?> <?php echo e($data['tax']); ?>% : <span>+ <?php echo e(get_price($data['tax_amount'])); ?></span></p>
                                        <?php endif; ?>
                                        <?php if(isset($data['shipping']) && floatval($data['shipping'])): ?>
                                            <p class="product-name"><?php echo e(__('msg.delivery_charge')); ?> : <span>+ <?php echo e(get_price($data['shipping'])); ?></span></p>
                                        <?php endif; ?>
                                        <?php if(isset($data['coupon']['discount']) && floatval($data['coupon']['discount'])): ?>
                                            <p class="product-name"><?php echo e(__('msg.discount')); ?> : <span>- <?php echo e(get_price($data['coupon']['discount'])); ?></span></p>
                                        <?php endif; ?>
                                        <p class="product-name"><?php echo e(__('msg.total')); ?> : <span> <?php echo e($data['total']); ?></span></p>                                       
                                    </td>
                                </tr>                                
                                <tr class="text-left">
                                    <td>
                                        <strong>
                                            <p class="checkout-total walletNotUsed"><?php echo e(__('msg.final_total')); ?> : <span><?php echo e($data['total']); ?></span></p>
                                            <?php if(intval($data['user']['balance'] ?? 0)): ?>
                                                <?php if(floatval($data['user']['balance']) > floatval($data['total'])): ?>
                                                    <p class="product-name walletUsed"><?php echo e(__('msg.wallet_from')); ?> : <span><?php echo e(floatval($data['total'])); ?></span></p>
                                                    <p class="checkout-total walletUsed"><?php echo e(__('msg.total_payable')); ?> : <span> 0</span></p>
                                                <?php else: ?>
                                                    <p class="product-name walletUsed"><?php echo e(__('msg.wallet_from')); ?> : <span>- <?php echo e($data['user']['balance'] ?? '0'); ?></span></p>
                                                    <p class="checkout-total walletUsed"><?php echo e(__('msg.total_payable')); ?> : <span> <?php echo e(floatval($data['total']) - floatval($data['user']['balance'])); ?></span></p>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </strong>
                                    </td>
                                </tr>
                            </div>
                            <div class="row add-to-fav1 mr-4">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo e(__('msg.cancel')); ?></button>
                                <form action="<?php echo e(route('checkout-proceed')); ?>" method="POST">
                                    <input type="hidden" name="deliverDay" id="date">
                                    <input type="hidden" name="deliveryTime">
                                    <input type="hidden" name="paymentMethod">
                                    <input type="hidden" name="wallet_used" value="false">
                                    <?php if(intval($data['user']['balance'] ?? 0)): ?>
                                        <?php if(floatval($data['user']['balance']) > floatval($data['total'])): ?>                                        
                                            <input type="hidden" name="wallet_balance" value="<?php echo e(floatval($data['total'])); ?>">
                                        <?php else: ?>
                                            <input type="hidden" name="wallet_balance" value="<?php echo e(floatval($data['total']) - floatval($data['user']['balance'])); ?>">
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <input type="hidden" name="wallet_balance" value="0">
                                    <?php endif; ?>
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary ml-2"><?php echo e(__('msg.confirm')); ?></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</section>
<script src="<?php echo e(asset('js/checkout-payment.js')); ?>"></script><?php /**PATH /home/thetricu/titalidesingerstudio.com/resources/views/themes/ekart/checkout_payment.blade.php ENDPATH**/ ?>