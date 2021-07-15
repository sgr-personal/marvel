
<?php if(isset($s->products) && is_array($s->products) && count($s->products)): ?>
    <!-- section trending products -->
    <section class="section-content padding-bottom card-trand spacingrm">
        <div class="container">
            <h4 class="title-section title-sec font-weight-bold"><?php echo e($s->title); ?> <small class="text-secondary short-desc"><?php echo e($s->short_description); ?></small></h4>
            <hr class="line">
            <div class="card-product-trend card-deal">
                <div class="row no-gutters items-wrap mx-auto">
                    <?php   $maxProductShow = get('style_1.max_product_on_homne_page'); ?>
                    <?php $__currentLoopData = $s->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if((--$maxProductShow) > -1): ?>
                            <div class="col-md-3 col-lg-3 col-xl col-6">
                                <figure class="card-product-grid card-sm">
                                    <a href="<?php echo e(route('product-single', $p->slug)); ?>" class="img-wrap">
                                        <img src="<?php echo e($p->image); ?>" alt="<?php echo e($p->name ?? 'Product Image'); ?>">
                                    </a>
                                    <div class="text-wrap p-3 text-left">
                                        <a href="<?php echo e(route('product-single', $p->slug)); ?>" class="title font-weight-bold product-name mb-2"><?php echo e($p->name); ?></a>
                                        <span class="text-muted style-desc">
                                            <?php if(strlen(strip_tags($p->description)) > 20): ?> <?php echo substr(strip_tags($p->description), 0,20)."..."; ?> <?php else: ?> <?php echo substr(strip_tags($p->description), 0,20); ?> <?php endif; ?>
                                        </span>
                                        <div class="price mt-2 ">
                                            <strong><?php echo print_price($p); ?></strong> &nbsp; <s class="text-muted"><?php echo print_mrp($p); ?></s>
                                            <small class="text-success"> <?php echo e(get_savings_varients($p->variants[0])); ?> </small>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        <?php else: ?>
                            <?php break; ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="col-heading content-body col-md-3 col-6">
                        <header class="section-heading">
                            <h3 class="section-title ml-4"><?php echo e($s->title); ?></h3>
                            <p class="ml-4"><?php echo e($s->short_description); ?></p>
                        </header><!-- sect-heading -->

                        <div class="col text-left ml-2">
                            <a type="button" href="<?php echo e(route('shop', ['section' => $s->slug])); ?>" class="view-all btn btn-primary"><?php echo e(__('msg.view_all')); ?></a>
                        </div>
                    </div> <!-- col.// -->
                </div>
            </div>
        </div>
    </section>
    <!--end tranding products-->
<?php endif; ?><?php /**PATH D:\wamp64\www\marvel\resources\views/themes/ekart/parts/style_1.blade.php ENDPATH**/ ?>