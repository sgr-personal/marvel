<section class="section-content padding-bottom footerfix">
    <a href="#" id="scroll"><span></span></a>
    <nav aria-label="breadcrumb" class="mt-5">
        <ol class="breadcrumb">
            <li class=" item-1"></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('my-account')); ?>"><?php echo e(__('msg.my_account')); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('msg.favourites')); ?></li>
        </ol>
    </nav>
    <div class="container mt-5">
        <?php if(isset($data['list']['data']) && is_array($data['list']['data']) && count($data['list']['data'])): ?>
            <div class="row ekart spacingrm">
                <?php $__currentLoopData = $data['list']['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-6 recent-add">
                        <figure class="card card-sm card-product-grid">
                            <aside class="add-to-fav">
                                <a type="button" class="btn" href="<?php echo e(route('favourite-remove', $itm->product_id)); ?>">
                                    <em class="fas fa-heart"></em>
                                </a>
                            </aside>
                            <a href="<?php echo e(route('product-single', $itm->slug)); ?>" class="img-wrap"> <img src="<?php echo e($itm->image); ?>" alt="<?php echo e($tim->name ?? 'Product Image'); ?>"> </a>
                            <figcaption class="info-wrap">
                                <div class="text-wrap p-3 text-left">
                                    <a href="<?php echo e(route('product-single', $itm->slug)); ?>" class="title font-weight-bold product-name mb-2"><?php echo e($itm->name); ?></a>

                                    <div class="price mt-1 ">
                                        <strong id="price_<?php echo e($itm->id); ?>"><?php echo print_price($itm); ?></strong> &nbsp; <s class="text-muted" id="mrp_<?php echo e($itm->id); ?>"><?php echo print_mrp($itm); ?></s>
                                        <small class="text-success" id="savings_<?php echo e($itm->id); ?>"> <?php echo e(get_savings_varients($itm->variants[0])); ?> </small>
                                    </div>
                                </div>
                            </figcaption>
                            <span class="inner">
                                <form action='<?php echo e(route('cart-add')); ?>' method="POST">
                                    <input type="hidden" name='id' value='<?php echo e($itm->product_id); ?>'>
                                    <input type="hidden" name="type" value='add'>
                                    <input type="hidden" name="child_id" value='<?php echo e($itm->variants[0]->id); ?>' id="child_<?php echo e($itm->id); ?>">
                                    <select name="varient" data-id="<?php echo e($itm->id); ?>">
                                        <?php $__currentLoopData = $itm->variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(intval($v->stock)): ?>
                                                <option value="<?php echo e($v->id); ?>"  data-price='<?php echo e(get_price(get_price_varients($v))); ?>' data-mrp='<?php echo e(get_price(get_mrp_varients($v))); ?>' data-savings='<?php echo e(get_savings_varients($v)); ?>'><?php echo e(get_varient_name($v)); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                    <button type="submit" name="submit" class="btn fa fa-shopping-cart"><span>&nbsp;&nbsp;<?php echo e(__('msg.add_to_cart')); ?></span></button>
                                </form>
                            </span>
                        </figure>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="row text-center">
                <div class="col-12">
                    <br><br>
                    <h3><?php echo e(__('msg.no_favorites_product_found')); ?></h3>
                </div>
                <div class="col-12">
                    <br><br>
                    <a href="<?php echo e(route('shop')); ?>" class="btn btn-primary"><em class="fa fa-chevron-left mr-1"></em> <?php echo e(__('msg.continue_shopping')); ?></a>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col">
                <?php if(isset($data['last']) && $data['last'] != ""): ?>
                    <a href="<?php echo e($data['last']); ?>" class="btn btn-primary pull-left text-white"><em class="fa fa-arrow-left"></em> <?php echo e(__('msg.previous')); ?></a>
                <?php endif; ?>
            </div>
            <div class="col favnext text-right">
                <?php if(isset($data['next']) && $data['next'] != ""): ?>
                    <a href="<?php echo e($data['next']); ?>" class="btn btn-primary pull-right text-white"><?php echo e(__('msg.next')); ?> <em class="fa fa-arrow-right"></em></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section><?php /**PATH /home/thetricu/marvel.niktechsolution.com/resources/views/themes/ekart/user/favorites.blade.php ENDPATH**/ ?>