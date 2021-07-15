<table class="table table-hover">
    <thead>
    <tr>
        <td class="td-main">#</td>
        <td class="td-main">Item Description</td>
        <td class="td-main">Price</td>
    </tr>
    </thead>
    <tbody>

    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($key++); ?></td>
            <td>
                <div class="media">
                    <div class="media-body">
                        <p class="mt-0 title"><?php echo e($product->product_name); ?></p>
                        <?php echo e($product->description); ?>

                    </div>
                </div>
            </td>
            <td><?php echo e("ksh".$product->price); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH D:\wamp64\www\marvel\resources\views/themes/ekart/quotation.blade.php ENDPATH**/ ?>