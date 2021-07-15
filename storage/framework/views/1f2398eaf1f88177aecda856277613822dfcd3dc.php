<aside class="col-md-3 padding-bottom">
    <div class="list-group mb-1">
        <a href="<?php echo e(route('my-orders')); ?>" class="list-group-item"> <span><em class="fas fa-align-justify mr-2"></em> <?php echo e(__('msg.all_orders')); ?></span></a>
        <a href="<?php echo e(route('my-orders', 'processed')); ?>" class="list-group-item"> <span><em class="fa fa-tasks mr-2"></em> <?php echo e(__('msg.in_process')); ?></span></a>
        <a href="<?php echo e(route('my-orders', 'received')); ?>" class="list-group-item"> <span><em class="fa fa-list-ul mr-2"></em> <?php echo e(__('msg.received')); ?></span></a>
        <a href="<?php echo e(route('my-orders', 'shipped')); ?>" class="list-group-item"> <span><em class="fa fa-ship mr-2"></em> <?php echo e(__('msg.shipped')); ?></span></a>
        <a href="<?php echo e(route('my-orders', 'delivered')); ?>" class="list-group-item"> <span><em class="fa fa-truck mr-2"></em> <?php echo e(__('msg.delivered')); ?></span></a>
        <a href="<?php echo e(route('my-orders', 'cancelled')); ?>" class="list-group-item"> <span><em class="fa fa-ban mr-2"></em> <?php echo e(__('msg.cancelled')); ?></span></a>
        <a href="<?php echo e(route('my-orders', 'returned')); ?>" class="list-group-item"> <span><em class="fa fa-undo mr-2"></em> <?php echo e(__('msg.returned')); ?></span></a>   
   </div>
</aside><?php /**PATH /home/thetricu/titalidesingerstudio.com/resources/views/themes/ekart/user/order-sidebar.blade.php ENDPATH**/ ?>