<!--<?php if(Cache::has('categories') && is_array(Cache::get('categories')) && count(Cache::get('categories'))): ?>
    section categories popular categories transparent image
    <section class="section-content padding-bottom mt-4 spacingrm">
        <div class="container">
            <h4 class="title-section font-weight-bold"><?php echo e(__('msg.popular_categories')); ?></h4>
            <hr class="line">
            <div class="popular">
                <div class="row p-0">
                    <?php $__currentLoopData = Cache::get('categories'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="item category-item-card rounded">
                                <img class="category-item" src="<?php echo e($c->name ?? 'image'); ?>" alt="<?php echo e($c->name ?? 'Category'); ?>">
                                <span class="overlay-text">
                                    <p class="text-dark title font-weight-bold name mb-0"><?php echo e($c->name); ?></p>
                                    <small class="text-muted subtitle"><?php echo e($c->subtitle); ?></small>
                                    <p class="m-0">
                                        <a href="<?php echo e(route('category', $i)); ?>" class="shop-now"><?php echo e(__('msg.shop_now')); ?> <em class="fa fa-chevron-right"></em></a>
                                    </p>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>
    end section categories
<?php endif; ?>-->
<?php if(Cache::has('categories') && is_array(Cache::get('categories')) && count(Cache::get('categories'))): ?>
	<!--section categories popular categories transparent image-->
    <section class="section-content padding-bottom popular-categories">
		<div class="container">
			<h4 class="title-section text-uppercase font-weight-bold"><?php echo e(__('msg.popular_categories')); ?></h4>
			<hr class="line">
			<div class="">
				<div class="row p-0">
					<?php $__currentLoopData = Cache::get('categories'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="col-lg-4 col-md-6 col-12">
                                                    <?php if($c->web_image !== ''): ?>
							<div class="item popular web">
                                                            <img class="category-item" src="<?php echo e($c->web_image); ?>" alt="<?php echo e($c->name ?? 'Category'); ?>">
                                                            <span class="overlay-text">
                                                                <p class="text-dark title font-weight-bold name mb-0"><?php echo e($c->name); ?></p>
                                                                <small class="text-muted subtitle"><?php echo e($c->subtitle); ?></small>
                                                                <p class="m-0">
                                                                    <a href="<?php echo e(route('category', $i)); ?>" class="shop-now"><?php echo e(__('msg.shop_now')); ?> <i class="fa fa-chevron-right"></i></a>
                                                                </p>
                                                            </span>
							</div>
                                                    <?php else: ?>
                                                    <div class="item category-item-card rounded">
                                                        <img class="category-item" src="<?php echo e($c->image); ?>" alt="<?php echo e($c->name ?? 'Category'); ?>">
                                                        <span class="overlay-text">
                                                            <p class="text-dark title font-weight-bold name mb-0"><?php echo e($c->name); ?></p>
                                                            <small class="text-muted subtitle"><?php echo e($c->subtitle); ?></small>
                                                            <p class="m-0">
                                                                <a href="<?php echo e(route('category', $i)); ?>" class="shop-now"><?php echo e(__('msg.shop_now')); ?> <em class="fa fa-chevron-right"></em></a>
                                                            </p>
                                                        </span>
                                                    </div>
                                                    <?php endif; ?>

						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		</div>
    </section>
    <!--end section categories-->
<?php endif; ?><?php /**PATH D:\wamp64\www\marvel\resources\views/themes/ekart/parts/categories.blade.php ENDPATH**/ ?>