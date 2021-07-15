<section class="footerfix section-content padding-bottom">
    <a href="#" id="scroll"><span></span></a>
    <div class="container">
        <nav class="row row-eq-height">
            <?php if(isset($data['sub-categories'])): ?>
            <?php $__currentLoopData = $data['sub-categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3 mt-2">
                <a href="<?php echo e(route('shop', ['category' => $data['category']->slug, 'sub-category' => $c->slug])); ?>">
                    <div class="card card-category eq-height-element">
                        <div class="img-wrap">
                            <img src="<?php echo e($c->image); ?>" alt="<?php echo e($c->name ?? ''); ?>">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><?php echo e($c->name); ?></h4>
                            <p><?php echo e($c->subtitle); ?></p>
                        </div>
                    </div>
                </a>
            </div>               
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <div class="row">
                <div class="col">
                    <br><br>
                    <h1 class="text-center"><?php echo e(__('msg.no_subcategory_found')); ?></h1>
                </div>
            </div>
            <?php endif; ?>
        </nav>
    </div>
</section><?php /**PATH /home/thetricu/marvel.niktechsolution.com/resources/views/themes/ekart/sub-categories.blade.php ENDPATH**/ ?>