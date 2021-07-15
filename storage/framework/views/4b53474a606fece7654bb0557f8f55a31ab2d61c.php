<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo e(Cache::get('app_name', get('name'))); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >
        <script src="<?php echo e(theme('js/jquery-3.5.1.min.js')); ?>"></script>
        <script id="bolt" src="<?php echo e($data['payment_url']); ?>" bolt-color="e34524" bolt-logo="<?php echo e(asset('images/headerlogo.png')); ?>"></script>
    </head>
    <body>
        <form action="#" method="POST">
            <input type="hidden" name="key" id="key" value="<?php echo e($data['key'] ?? ''); ?>">
            <input type="hidden" name="txnid" id="txnid" value="<?php echo e($data['txnid'] ?? ''); ?>">
            <input type="hidden" name="hash" id="hash" value="<?php echo e($data['hash'] ?? ''); ?>">
            <input type="hidden" name="amount" id="amount" value="<?php echo e($data['amount'] ?? ''); ?>">
            <input type="hidden" name="fname" id="fname" value="<?php echo e($data['firstname'] ?? ''); ?>">
            <input type="hidden" name="email" id="email" value="<?php echo e($data['email'] ?? ''); ?>">
            <input type="hidden" name="phone" id="phone" value="<?php echo e($data['phone'] ?? ''); ?>">
            <input type="hidden" name="pinfo" id="pinfo" value="<?php echo e($data['productinfo'] ?? ''); ?>">
            <input type="hidden" name="surl" id="surl" value="<?php echo e($data['surl'] ?? ''); ?>">
            <input type="hidden" name="furl" id="furl" value="<?php echo e($data['furl'] ?? ''); ?>">
        </form>
    </body>
    <script src="<?php echo e(asset('js/payment-gateway-payumoney.js')); ?>"></script>
</html><?php /**PATH /home/thetricu/titalidesingerstudio.com/resources/views/payment-gateways/payu-bolt.blade.php ENDPATH**/ ?>