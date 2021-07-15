<aside class="col-md-3">
    <div class="card mb-3">
        <div class="card-body">
            <div class="profile-header-container">
                <div class="profile-header-img">
                    <a class="navbar-brand ml-2" href="<?php echo e(route('home')); ?>">
                        <a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(_asset(Cache::get('web_logo'))); ?>" alt="logo"></a>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="list-group">
        <a href="<?php echo e(route('my-account')); ?>" class="list-group-item"><em class="fa fa-user"></em><span class="side-menu"><?php echo e(__('msg.my_profile')); ?></span></a>
        <a href="<?php echo e(route('change-password')); ?>" class="list-group-item"><em class="fa fa-asterisk"></em><span class="side-menu"><?php echo e(__('msg.change_password')); ?></span></a>
        <a href="<?php echo e(route('my-orders')); ?>" class="list-group-item"><em class="fas fa-taxi"></em><span class="side-menu"><?php echo e(__('msg.my_orders')); ?></span></a>
        <a href="<?php echo e(route('notification')); ?>" class="list-group-item"><em class="fa fa-bell"></em><span class="side-menu"><?php echo e(__('msg.notifications')); ?></span></a>
        <a href="<?php echo e(route('favourite')); ?>" class="list-group-item"><em class="fa fa-heart"></em><span class="side-menu"><?php echo e(__('msg.favourite')); ?></span></a>
        <a href="<?php echo e(route('wallet-history')); ?>" class="list-group-item"><em class="fab fa-google-wallet"></em><span class="side-menu"><?php echo e(__('msg.wallet_history')); ?></span></a>
        <a href="<?php echo e(route('transaction-history')); ?>" class="list-group-item"><em class="fa fa-outdent"></em><span class="side-menu"><?php echo e(__('msg.transaction_history')); ?></span></a>
        <a href="<?php echo e(route('refer-earn')); ?>" class="list-group-item"><em class="fa fa-user-plus"></em><span class="side-menu"><?php echo e(__('msg.refer_and_earn')); ?></span></a>
        <a href="<?php echo e(route('addresses')); ?>" class="list-group-item"><em class="fa fa-wrench"></em><span class="side-menu"><?php echo e(__('msg.manage_addresses')); ?></span></a>
        <a href="<?php echo e(route('logout')); ?>" class="list-group-item"><em class="fa fa-sign-out-alt"></em><span class="side-menu"><?php echo e(__('msg.logout')); ?></span></a>
    </div>
</aside><?php /**PATH /home/thetricu/marvel.niktechsolution.com/resources/views/themes/ekart/user/sidebar.blade.php ENDPATH**/ ?>