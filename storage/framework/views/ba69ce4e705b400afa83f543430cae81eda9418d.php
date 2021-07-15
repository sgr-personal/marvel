

<?php if(isset($s->products) && is_array($s->products) && count($s->products)): ?>
    <!---section polular categories-->
    <section class="section-content padding-bottom ekartspec">
        <div class="container">
            <h4 class="title-section title-sec font-weight-bold"><?php echo e($s->title); ?> <small class="text-muted short-desc"><?php echo e($s->short_description); ?></small></h4>
            <?php if(isset($s->slug) && $s->slug != ""): ?>
                <a href="<?php echo e(route('shop', ['section' => $s->slug])); ?>" class="view  title-section viewall"><?php echo e(__('msg.view_all')); ?></a>
            <?php endif; ?>
            <hr class="line">
            <div class="row respondiv">
                <?php $maxProductShow = get('style_3.max_product_on_homne_page'); ?>
                <?php $__currentLoopData = $s->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if((--$maxProductShow-1) > -1): ?>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="card-popular-category">
                                <a href="<?php echo e(route('product-single', $p->slug)); ?>">
                                <div class="col-4">
                                    <img class="rounded" src="<?php echo e($p->image); ?>" alt="<?php echo e($p->name ?? 'Product Name'); ?>">
                                </div>
                                </a>
                                <div class="col-8">
                                    <div class="text-wrap p-2 text-left">
                                        <a href="<?php echo e(route('product-single', $p->slug)); ?>" class="title font-weight-bold product-name"><?php echo e($p->name); ?></a>
                                        <span class="text-muted"><?php if(strlen(strip_tags($p->description)) > 60): ?> <?php echo substr(strip_tags($p->description), 0,60)."..."; ?> <?php else: ?> <?php echo substr(strip_tags($p->description), 0,60); ?> <?php endif; ?></span>
                                        <div class="price mt-1 ">
                                            <strong><?php echo print_price($p); ?></strong>&nbsp; <s class="text-muted"><?php echo print_mrp($p); ?></s>
                                            <small class="text-success ml-3"> <?php echo e(get_savings_varients($p->variants[0])); ?> </small>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <!---end section categories-->
<?php endif; ?><?php /**PATH /home/thetricu/marvel.niktechsolution.com/resources/views/themes/ekart/parts/style_3.blade.php ENDPATH**/ ?>