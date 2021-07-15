<?php if(isset($data['breadcrumb'])): ?>
    <section class="padding-bottom mt-5">
        <nav aria-label="breadcrumb"> 
            <ol class="breadcrumb">
                <li class=" item-1"></li>
                <?php $__currentLoopData = $data['breadcrumb']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="breadcrumb-item"><a href="<?php echo e($b['link']); ?>"><?php echo strtoupper($b['title']); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ol>
        </nav> 
    </section>
<?php endif; ?><?php /**PATH /home/thetricu/marvel.niktechsolution.com/resources/views/themes/ekart/parts/breadcrumb.blade.php ENDPATH**/ ?>