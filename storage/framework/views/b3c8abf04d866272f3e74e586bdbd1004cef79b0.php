<!-- product detail page -->
<div class="section-content mt-5">
    <a href="#" id="scroll"><span></span></a>
    <div class="container mt-5 padding-bottom">
        <div class="card pb-4 mt-5">
            <!--Grid row-->
            <div class="row mt-5">
                <!--Grid column-->
                <div class="col-lg-6 col-md-12 col-12 pics text-center productdetails1">
                    <?php $count=1; ?>
                    <div class="wrap-gallery-article">
                        <div id="myCarouselArticle" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#myCarouselArticle" data-slide-to="0" <?php echo e($count == 0 ? 'class="active"' : ''); ?>></li>
                                <?php if(isset($data['product']->other_images) && is_array($data['product']->other_images) && count($data['product']->other_images)): ?>
                                    <?php $__currentLoopData = $data['product']->other_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li data-target="#myCarouselArticle" data-slide-to="<?php echo e($count); ?>"></li>
                                    <?php $count++; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <img class="outerdetailimg" src="<?php echo e($data['product']->image); ?>" alt="<?php echo e($data['product']->name ?? 'Product Image'); ?>">
                                </div>
                                <?php if(isset($data['product']->other_images) && is_array($data['product']->other_images) && count($data['product']->other_images)): ?>
                                    <?php $__currentLoopData = $data['product']->other_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="carousel-item">
                                        <img class="outerdetailimg" src="<?php echo e($img); ?>" alt="<?php echo e($data['product']->name ?? 'Product Image'); ?>">
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                            <a class="carousel-control-prev" href="#myCarouselArticle" role="button" data-slide="prev">
                                <em class="fa fa-angle-left text-dark font-weight-bold"></em>
                            </a>

                            <a class="carousel-control-next" href="#myCarouselArticle" role="button" data-slide="next">
                                <em class="fa fa-angle-right text-dark font-weight-bold"></em>
                            </a>
                        </div>
                        <br>

                        <div class="row hidden-xs " id="slider-thumbs">
                            <!-- Bottom switcher of slider -->
                            <ul class="reset-ul d-flex flex-wrap list-thumb-gallery">
                                <li class="col-sm-3 col-3 thumb-gallery-smallimg">
                                    <a class="thumbnail" data-target="#myCarouselArticle" data-slide-to="0">
                                        <img class="img-fluid" src="<?php echo e($data['product']->image); ?>" alt="<?php echo e($data['product']->name ?? 'Product Image'); ?>">
                                    </a>
                                </li>
                                <?php $count=1; ?>
                                <?php $__currentLoopData = $data['product']->other_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="col-sm-3 col-3 thumb-gallery-smallimg">
                                        <a class="thumbnail thumbnailimg" data-target="#myCarouselArticle" data-slide-to="<?php echo e($count); ?>">
                                            <img class="img-fluid" src="<?php echo e($img); ?>" alt="<?php echo e($data['product']->name ?? 'Product Image'); ?>">
                                        </a>
                                    </li>
                                <?php $count++; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-lg-6 col-md-12 col-12 productdetails2 ">
                    <aside class="add-to-fav">
                        <button type="button" class="btn <?php echo e((isset($data['product']->is_favorite) && intval($data['product']->is_favorite)) ? 'saved' : 'save'); ?>" data-id='<?php echo e($data['product']->id); ?>' />
                    </aside>
                    <!--Content-->
                    <div class="text-left">
                        <p class="lead title-sec font-weight-bold"><?php echo e($data['product']->name ?? '-'); ?></p>
                        <p></p>
                        <hr class="line1 ml-0">
                        <p class="mt-2 read-more desc"><?php if(strlen($data['product']->description) > 200): ?> <?php echo substr($data['product']->description, 0,200) ."..."; ?> <?php else: ?> <?php echo substr($data['product']->description, 0,200); ?> <?php endif; ?>
                            <?php if(strlen($data['product']->description) > 200): ?>
                                <a class="more-content" href="#desc" id="description"><?php echo e(__('msg.read_more')); ?></a>
                            <?php endif; ?>
                        </p>
                        <?php if(count(getInStockVarients($data['product']))): ?>
                            <hr class="line1 ml-0">
                            <p class="text-muted" id="price_mrp_<?php echo e($data['product']->id); ?>"><del><?php echo e(__('msg.price')); ?>: <span class='value'></span></del></p>
                            <h5 class="font-weight-bold title-sec" id="price_offer_<?php echo e($data['product']->id); ?>"><?php echo e(__('msg.offer_price')); ?>: <?php echo e(Cache::get('currency')); ?> <span class='value'></span></h5>
                            <h5 class="font-weight-bold" id="price_regular_<?php echo e($data['product']->id); ?>"><?php echo e(__('msg.price')); ?>: <span class='value'></span></h5>
                            <small class="text-primary" id="price_savings_<?php echo e($data['product']->id); ?>"><?php echo e(__('msg.you_save')); ?>: <?php echo e(Cache::get('currency')); ?> <span class='value'></span></small>
                            <div class="form">
                                <form action="<?php echo e(route('cart-add')); ?>" class="addToCart" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name='id' value='<?php echo e($data['product']->id); ?>'>
                                    <input type="hidden" name="type" value='add'>
                                    <input type="hidden" name="child_id" value='0' id="child_<?php echo e($data['product']->id); ?>">
                                    <div class="row mt-4">
                                        <div class="button-container col">
                                            <button class="cart-qty-minus button-minus" type="button" id="button-minus" value="-">-</button>
                                            <input class="form-control qtyPicker" id="qtyPicker_<?php echo e($data['product']->id); ?>" type="number" name="qty" data-min="0" min="1" max="1" data-max="1" value="1" readonly>
                                            <button class="cart-qty-plus button-plus" type="button" id="button-plus" value="+">+</button>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="form-group col">
                                            <div class="btn-group-toggle variant" data-toggle="buttons">
                                                <?php $firstSelected = true; ?>
                                                <?php $__currentLoopData = getInStockVarients($data['product']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <button class="btn" data-id="<?php echo e($data['product']->id); ?>">
                                                        <span class="text-dark name"><?php echo e(get_varient_name($v)); ?></span><br>
                                                        <small> <?php echo e(__('msg.option_from')); ?> <?php echo e(get_price_varients($v)); ?></small>
                                                        <input type="radio" name="options" id="option<?php echo e($v->id); ?>" value="<?php echo e($v->id); ?>" data-id='<?php echo e($v->id); ?>' data-price='<?php echo e(get_price_varients($v)); ?>' data-mrp='<?php echo e(get_mrp_varients($v)); ?>' data-savings='<?php echo e(get_savings_varients($v, false)); ?>' data-stock='<?php echo e(intval(getMaxQty($v))); ?>' autocomplete="off" >
                                                    </button>
                                                    <?php if($firstSelected == true): ?>
                                                        <?php echo e($firstSelected = false); ?>

                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php if(intval($data['product']->indicator) == 2): ?>
                                            <img src="<?php echo e(asset('images/nonvag.svg')); ?>" alt="Not Vegetarian Product">
                                            <span class="text-left ml-1"> <?php echo e(__('msg.not')); ?> <strong><?php echo e(__('msg.vegetarian')); ?></strong> <?php echo e(__('msg.v_product')); ?>.</span>
                                        <?php elseif(intval($data['product']->indicator) == 1): ?>
                                            <img src="<?php echo e(asset('images/vag.svg')); ?>" alt="Vegetarian Product">
                                            <span class="text-left ml-1"> <?php echo e(__('msg.this_is')); ?> <strong><?php echo e(__('msg.vegetarian')); ?></strong> <?php echo e(__('msg.v_product')); ?>.</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group text-left add-to-cart1">
                                        <button type="submit" name="submit" class="btn">
                                            <em class="fa fa-shopping-cart"> <span class="text-uppercase ml-2"><?php echo e(__('msg.add_to_cart')); ?></span></em>
                                        </button>
                                        <button class="buy-now btn btn-primary text-center text-uppercase text-white" type="submit" name="submit" value="buynow"> <span class="buy-now1"><?php echo e(__('msg.buy_now')); ?></span></button>
                                    </div>
                                </form>
                            </div>
                        <?php else: ?>
                            <span class="sold-out"><?php echo e(__('msg.sold_out')); ?></span>
                        <?php endif; ?>
                         <div class="row card-content text-center policycontent">
                    <?php if(isset($data['product']->return_status)): ?>
                        <div class="card productcard p-3 col-12 col-md-6 col-lg-4 returnpolicy">
                            <?php if(intval($data['product']->return_status)): ?>
                                <div class="card-img pb-3">
                                    <span class="creativity">
                                        <img src="<?php echo e(asset('images/returnable.png')); ?>" alt="Returnable">
                                    </span>
                                </div>
                                <div class="card-box">
                                    <h6 class="card-title py-3 text-center"><?php echo e(Cache::get('max-product-return-days')); ?>  <?php echo e(__('msg.days')); ?> <?php echo e(__('msg.returnable')); ?></h6>

                                </div>
                            <?php else: ?>
                                <div class="card-img pb-3">
                                    <span class="creativity">
                                        <img src="<?php echo e(asset('images/not-returnable.svg')); ?>" alt="notReturnable">
                                    </span>
                                </div>
                                <div class="card-box">
                                    <h6 class="card-title py-3 text-center"><?php echo e(__('msg.not_returnable')); ?></h6>

                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if(isset($data['product']->cancelable_status)): ?>
                        <div class="card productcard p-3 col-12 col-md-6 col-lg-4 returnpolicy">
                            <?php if(intval($data['product']->cancelable_status)): ?>
                                <div class="card-img pb-3">
                                    <span class="creativity">
                                        <img src="<?php echo e(asset('images/cancellable.png')); ?>" alt="Cancellable">
                                    </span>
                                </div>
                                <div class="card-box">
                                    <h6 class="card-title py-3 text-center"><?php echo e(__('msg.order_can_cancel_till_order')); ?> <?php echo e(strtoupper($data['product']->till_status ?? '')); ?></h6>

                                </div>
                            <?php else: ?>
                                <div class="card-img pb-3">
                                    <span class="creativity">
                                        <img src="<?php echo e(asset('images/not-cancellable.svg')); ?>" alt="notCancellable">
                                    </span>
                                </div>
                                <div class="card-box">
                                    <h6 class="card-title py-3 text-center"><?php echo e(__('msg.not_cancellable')); ?></h6>

                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                </div>
                   </div>
                </div>
            </div>



                
                 <!--returnable and cancelable status-->
        <div class="features1 service-quality padding-bottom">
            <div class=" container text-center justify-content-center">
                <span class="border-line"></span>


            </div>
        </div>
        <!--end returnable and cancelable status-->

        </div>


                        <!--Grid row tab content-->
                <div class="row padding-bottom">
                    <div class="col-md-12 mt-5">
                    <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                            <a class="nav-link active product-info title-sec" href="#desc" role="tab" data-toggle="tab"><?php echo e(__('msg.product_details')); ?></a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content box rounded product-info-tab">
                            <div role="tabpanel" class="tab-pane active bg-white text-dark" id="desc"><?php echo $data['product']->description; ?></div>
                        </div>

                        <div class="m-2">
                            <?php if(isset($data['product']->manufacturer) && trim($data['product']->manufacturer) != ""): ?>
                                <p><?php echo e(__('msg.manufacturer')); ?> : <?php echo e($data['product']->manufacturer); ?></p>
                            <?php endif; ?>
                            <?php if(isset($data['product']->made_in) && trim($data['product']->made_in) != ""): ?>
                                <p><?php echo e(__('msg.made_in')); ?> : <?php echo e($data['product']->made_in); ?></p>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>




        <!--similar product-content-->
        <?php if(isset($data['similarProducts']) &&  !empty($data['similarProducts'])): ?>
            <section class="section-content padding-bottom mt-3 sellpro similarpro">

                <h4 class="title-sec font-weight-bold"><?php echo e(__('msg.similar_products')); ?>

                    <a href="<?php echo e(route('shop')); ?>" class="view title-section viewall"><?php echo e(__('msg.view_all')); ?></a>
                <hr class="line">

                <div class="ekart">
                <div class="row no-gutter">
                <?php   $maxProductShow = get('style_2.max_product_on_homne_page'); ?>
                <?php $__currentLoopData = $data['similarProducts']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
            </section>
        <?php endif; ?>
        <!--end similar product content-->
    </div>

</div>
<!-- end product detail page --><?php /**PATH /home/thetricu/marvel.niktechsolution.com/resources/views/themes/ekart/product.blade.php ENDPATH**/ ?>