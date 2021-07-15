<?php if(Cache::has('offers') && is_array(Cache::get('offers')) && count(Cache::get('offers'))): ?>
    <?php $__currentLoopData = Cache::get('offers'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(isset($o->image) && trim($o->image) !== ""): ?>
            <section class="section-content banneradvertise spacingrm">
                <div class="container">
                    <article class="padding-bottom">
                        <img src="<?php echo e($o->image); ?>" class="w-100" alt="offer">
                    </article>
                </div>
            </section>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>


<!---section advertise ---->


<!----section end advertise -->
<?php /**PATH D:\wamp64\www\marvel\resources\views/themes/ekart/parts/offers.blade.php ENDPATH**/ ?>