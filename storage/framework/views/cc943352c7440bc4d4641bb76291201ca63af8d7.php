
<?php if(isset($s->products) && is_array($s->products) && count($s->products)): ?>
    <!--section recently added and new on ekart -->
    <section class="section-content padding-bottom mt-3 sellpro">
        <div class="container">
            <?php if(isset($s->title) && $s->title != ""): ?>
                <h4 class="title-section title-sec font-weight-bold"><?php echo e($s->title); ?> <small class="text-muted short-desc"> <?php echo e($s->short_description); ?></h4>
                <?php if(isset($s->slug) && $s->slug != ""): ?>
                    <a href="<?php echo e(route('shop', ['section' => $s->slug])); ?>" class="view title-section viewall"><?php echo e(__('msg.view_all')); ?></a>
                <?php endif; ?>
                <hr class="line">
            <?php endif; ?>
            <div class="ekart">
                <div class="row no-gutter">
                    <?php   $maxProductShow = get('style_2.max_product_on_homne_page'); ?>
                    <?php $__currentLoopData = $s->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if((--$maxProductShow) > -1): ?>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-6 recent-add">
                                <figure class="card card-sm card-product-grid">
                                    <aside class="add-to-fav">
                                        <button type="button" class="btn <?php echo e((isset($p->is_favorite) && intval($p->is_favorite)) ? 'saved' : 'save'); ?>" data-id='<?php echo e($p->id); ?>' />
                                    </aside>
                                    <a href="<?php echo e(route('product-single', $p->slug)); ?>" class="img-wrap"> <img src="<?php echo e($p->image); ?>" alt="<?php echo e($p->name ?? 'Product Image'); ?>"> </a>
                                    <figcaption class="info-wrap">
                                        <div class="text-wrap p-3 text-left">
                                            <a href="<?php echo e(route('product-single', $p->slug)); ?>" class="title font-weight-bold product-name"><?php echo e($p->name); ?></a>

                                            <span class="text-muted style-desc">
                                                <?php if(strlen(strip_tags($p->description)) > 20): ?> <?php echo substr(strip_tags($p->description), 0,20)."..."; ?> <?php else: ?> <?php echo substr(strip_tags($p->description), 0,20); ?> <?php endif; ?>
                                            </span>
                                            <div class="price mt-1 ">
                                                <strong id="price_<?php echo e($p->id); ?>"><?php echo print_price($p); ?></strong> &nbsp; <s class="text-muted" id="mrp_<?php echo e($p->id); ?>"><?php echo print_mrp($p); ?></s>
                                                <small class="text-success" id="savings_<?php echo e($p->id); ?>"> <?php echo e(get_savings_varients($p->variants[0])); ?> </small>
                                            </div>
                                        </div>
                                    </figcaption>
                                    <?php if(count(getInStockVarients($p))): ?>
                                        <span class="inner">
                                            <form action='<?php echo e(route('cart-add-single-varient')); ?>' method="POST">
                                                <input type="hidden" name="id" value="<?php echo e($p->id); ?>">
                                                <select name="varient" data-id="<?php echo e($p->id); ?>">
                                                    <?php $__currentLoopData = getInStockVarients($p); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($v->id); ?>"  data-price='<?php echo e(get_price(get_price_varients($v))); ?>' data-mrp='<?php echo e(get_price(get_mrp_varients($v))); ?>' data-savings='<?php echo e(get_savings_varients($v)); ?>'><?php echo e(get_varient_name($v)); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <button type="submit" class="btn cart-1 fa fa-shopping-cart"><span>&nbsp;&nbsp;<?php echo e(__('msg.add_to_cart')); ?></span></button>
                                            </form>
                                        </span>
                                    <?php else: ?>
                                        <span class="sold-out"><?php echo e(__('msg.sold_out')); ?></span>
                                    <?php endif; ?>
                                </figure>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>
    <!--section end recently added and new on ekart -->
<?php endif; ?>
<?php /**PATH D:\wamp64\www\marvel\resources\views/themes/ekart/parts/style_2.blade.php ENDPATH**/ ?>