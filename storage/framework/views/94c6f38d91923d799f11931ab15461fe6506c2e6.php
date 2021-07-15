<!DOCTYPE HTML>
<html lang="en" dir="ltr">

<head>
    <link rel="icon" type="image/x-icon" href="<?php echo e(_asset(Cache::get('favicon', 'images/favicon.ico'))); ?>" />
    <title>
       
       Titali Desinger Studio
    </title>
    <meta charset="utf-8">
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="max-age=604800" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="ValuePac">
    <meta name="copyright" content="">
    <meta name="keywords" content="<?php echo e(Cache::get('common_meta_keywords', '')); ?>">
    <meta name="description" content="<?php echo e(Cache::get('common_meta_description', '')); ?>">

    <link href="<?php echo e(theme('css/ui.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- <link href="<?php echo e(theme('css/rtl_ui.css')); ?>" rel="stylesheet" type="text/css" />  -->
    <link href="<?php echo e(theme('css/custom.css')); ?>" rel="stylesheet" type="text/css" /> 
    <!-- <link href="<?php echo e(theme('css/rtl_custom.css')); ?>" rel="stylesheet" type="text/css" /> -->
    <link href="<?php echo e(theme('css/plugins.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- <link href="<?php echo e(theme('css/rtl_responsive.css')); ?>" rel="stylesheet" type="text/css" /> -->
     <link href="<?php echo e(theme('css/responsive.css')); ?>" rel="stylesheet" type="text/css" /> 

    <link href="<?php echo e(theme('css/stepper.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(theme('css/calender.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(theme('css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(theme('css/jquery-ui.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(theme('css/intlTelInput.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(theme('css/select2.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(theme('fonts/fontawesome/css/all.min.css')); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo e(theme('js/jquery-3.5.1.min.js')); ?>"></script>
    <script src="<?php echo e(theme('js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(theme('js/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(theme('js/intlTelInput.js')); ?>"></script>
    <script src="<?php echo e(theme('js/select2.min.js')); ?>"></script>


    <script>
        var home = "<?php echo e(get('home_url')); ?>";

    </script>
    <script src="<?php echo e(asset('js/script.js')); ?>"></script>

    <link href="<?php echo e(theme('css/cart.css')); ?>" rel="stylesheet" type="text/css" />

</head>

<body>
    <div class="mobile_overlay"></div>
    <div class="mobile_menu">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bar_open">
                        <a href="#"><i class="fas fa-bars"></i></a>
                    </div>
                    <div class="mobile_wrapper">
                        <div class="bar_close">
                            <a href="#"><i class="fas fa-times"></i></a>
                        </div>
                        <div class="freeshipping">
                            <p><?php echo e(__('msg.you_can_get_free_delivery_by_shopping_more_than')); ?>

                                <?php echo e(get_price(Cache::get('min_amount'))); ?></p>
                        </div>

                        <?php if(Cache::has('social_media') && is_array(Cache::get('social_media')) &&
                        count(Cache::get('social_media'))): ?>
                        <div class="header_social_icon text-center">
                            <ul>
                                <?php $__currentLoopData = Cache::get('social_media'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="social-icon">
                                    <a target="_blank" href="<?php echo e($c->link); ?>"><em class="fab <?php echo e($c->icon); ?>"></em></a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                        <?php if(trim(Cache::get('support_number', '')) != ''): ?>
                        <div class="header_call-support">
                            <p><a href="#"><?php echo e(Cache::get('support_number')); ?></a> Customer Support</p>
                        </div>
                        <?php endif; ?>
                        <div id="menu" class="text-left ">
                            <ul class="header_main_menu">
                                <li class="header_submenu_item active">
                                    <a href="<?php echo e(route('home')); ?>">Home</a>
                                    <!-- <ul class="sub-menu">
                                            <li><a href="#">Home 1</a></li>
                                            <li><a href="#">Home 2</a></li>
                                            <li><a href="#">Home 3</a></li>
                                            <li><a href="#">Home 4</a></li>
                                            <li><a href="#">Home 5</a></li>
                                        </ul>-->
                                </li>

                                <li class="header_submenu_item">
                                    <a href="<?php echo e(route('contact')); ?>"> Contact Us</a>
                                </li>

                                <li class="header_submenu_item">
                                    <a href="<?php echo e(route('shop')); ?>"> Shop</a>
                                </li>

                                <li class="header_submenu_item">
                                    <a href="#"> More</a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php echo e(route('page', 'about')); ?>">About Us</a></li>
                                        <li><a href="<?php echo e(route('page', 'faq')); ?>">FAQ</a></li>

                                        <?php if(isLoggedIn()): ?>
                                        <li><a href="<?php echo e(route('my-account')); ?>">My Account</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="offcanvas_footer">
                            <span><a href="#"><i class="fa fa-envelope"></i> <?php echo e(Cache::get('support_email')); ?></a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
    <!--offcanvas menu area end-->

    <header class="shadow-sm bg-white">
        <div class="main_header">
            <div class="header_top">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6">
                            <div class="freeshipping">
                                <p style="    color: #fff !important;"><?php echo e(__('msg.you_can_get_free_delivery_by_shopping_more_than')); ?>

                                    <?php echo e(get_price(Cache::get('min_amount'))); ?></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="header_social_icon text-right">
                                <?php if(Cache::has('social_media') && is_array(Cache::get('social_media')) &&
                                count(Cache::get('social_media'))): ?>
                                <ul>
                                    <?php $__currentLoopData = Cache::get('social_media'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="social-icon">
                                        <a target="_blank" href="<?php echo e($c->link); ?>"><em
                                                class="fab <?php echo e($c->icon); ?>"></em></a>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="secondheader">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-2 col-md-12 col-sm-12 col-12">
                            <div class="logo">
                                <a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(_asset(Cache::get('web_logo'))); ?>"
                                        alt="logo"></a>
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-12 col-sm-12 col-12">
                            <div class="header_right">
                                <div class="header_search mobile_screen_none">
                                    <form action="<?php echo e(route('shop')); ?>">
                                        <?php
                                        $categories = Cache::get('categories', []);
                                        ?>
                                        <div class="header_hover_category">
                                            <select class="select_option">
                                                <option selected">Select Category</option>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e(route('category', $i)); ?>""><?php echo e($c->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class=" header_search_box">
                                            <input type="text" class="form-control"
                                                value="<?php echo e(isset($_GET['s']) ? trim($_GET['s']) : ''); ?>" name="s"
                                                placeholder="Search Product...">
                                            <button type="submit"><i class="fas fa-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="header_account_area">
                                    <div class="header_account_list register">
                                        <?php if(isLoggedIn()): ?>
                                        <ul>
                                            <li><a href="<?php echo e(route('my-account')); ?>">My Account</a></li>
                                        </ul>
                                        <?php else: ?>
                                        <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
                                        <?php endif; ?>
                                    </div>
                                    <div class="header_account_list header_wishlist">
                                        <?php if(isLoggedIn()): ?>
                                        <a href="<?php echo e(route('favourite')); ?>"><i class="fas fa-heart fa-sm"></i></a>
                                        <?php endif; ?>
                                    </div>
                                    <?php if(isset($data['cart']['cart']) && is_array($data['cart']['cart']) &&
                                    count($data['cart']['cart'])): ?>
                                    <div class="header_account_list  mini_cart_wrapper">
                                        <?php else: ?>
                                        <div class="header_account_list">
                                            <?php endif; ?>

                                            <a href="#"><i class="fas fa-shopping-cart fa-sm"></i></a>
                                            <?php if(isset($data['cart']['cart']) && is_array($data['cart']['cart']) &&
                                            count($data['cart']['cart'])): ?>
                                            <span class="item_count"><?php echo e(count($data['cart']['cart'])); ?></span>
                                            <?php endif; ?>

                                            <?php if(isset($data['cart']['cart']) && is_array($data['cart']['cart']) &&
                                            count($data['cart']['cart'])): ?>
                                            <!--mini cart-->
                                            <div class="mini_cart">
                                                <div class="cart_gallery">
                                                    <div class="cart_close">


                                                    </div>
                                                    <table id="myTable" class="table ">
                                                        <tbody>
                                                            <tr>
                                                                <td class="mini_cart-subtotal">
                                                                    <span class="mini_cart_close">
                                                                        <a href="#"><em class="fas fa-times"></em></a>
                                                                    </span>

                                                                    <?php if(isset($data['cart']['cart']) &&
                                                                    is_array($data['cart']['cart']) &&
                                                                    count($data['cart']['cart'])): ?>
                                                                    <span class="text-right innersubtotal">
                                                                        <p class="product-name"><?php echo e(__('msg.subtotal')); ?> :
                                                                            <span><?php echo e(get_price($data['cart']['subtotal']) ?? '-'); ?></span>
                                                                        </p>
                                                                        <?php if(isset($data['cart']['tax_amount']) &&
                                                                        floatval($data['cart']['tax_amount'])): ?>
                                                                        <p class="product-name"><?php echo e(__('msg.tax')); ?>

                                                                            <?php echo e($data['cart']['tax'] ? $data['cart']['tax']."%" : ''); ?>

                                                                            : <span>+
                                                                                <?php echo e(get_price($data['cart']['tax_amount'])); ?></span>
                                                                        </p>
                                                                        <?php endif; ?>
                                                                        <?php if(isset($data['cart']['shipping']) &&
                                                                        floatval($data['cart']['shipping'])): ?>
                                                                        <p class="product-name">
                                                                            <?php echo e(__('msg.delivery_charge')); ?> : <span>+
                                                                                <?php echo e(get_price($data['cart']['shipping'])); ?></span>
                                                                        </p>
                                                                        <?php endif; ?>
                                                                        <?php if(isset($data['cart']['coupon']['discount'])
                                                                        &&
                                                                        floatval($data['cart']['coupon']['discount'])): ?>
                                                                        <p class="product-name"><?php echo e(__('msg.discount')); ?> :
                                                                            <span>-
                                                                                <?php echo e(get_price($data['cart']['coupon']['discount'])); ?></span>
                                                                        </p>
                                                                        <?php endif; ?>
                                                                        <p class="product-name"><?php echo e(__('msg.total')); ?> :
                                                                            <span>
                                                                                <?php echo e(get_price($data['cart']['total']) ?? '-'); ?></span>
                                                                        </p>
                                                                    </span>
                                                                </td>
                                                                <?php endif; ?>
                                                            </tr>

                                                            <?php if(isset($data['cart']['cart']) &&
                                                            is_array($data['cart']['cart']) &&
                                                            count($data['cart']['cart'])): ?>
                                                            <?php $__currentLoopData = $data['cart']['cart']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(isset($p->item[0])): ?>

                                                            <tr class="cart1price">
                                                                <td class="text-right checktrash cart">
                                                                    <a
                                                                        href="">
                                                                        <figure class="itemside">
                                                                            <div class="aside">
                                                                                <img src="<?php echo e($p->item[0]->image); ?>"
                                                                                    class="img-sm"
                                                                                    alt="<?php echo e($p->item[0]->name ?? 'Product Image'); ?>">
                                                                            </div>
                                                                            <figcaption class="info minicartinfo">
                                                                                <a href=""
                                                                                    class="title text-dark"><?php echo e($p->item[0]->name ?? '-'); ?></a>
                                                                                <span
                                                                                    class="small text-muted"><?php echo e(get_varient_name($p->item[0]) ?? '-'); ?></span>

                                                                                <br /><span
                                                                                    class="price-wrap cartShow"><?php echo e($p->qty); ?></span>
                                                                                <form
                                                                                    action="<?php echo e(route('cart-update', $p->product_id)); ?>"
                                                                                    method="POST" class="cartEdit">
                                                                                    <?php echo csrf_field(); ?>
                                                                                    <input type="hidden" name="child_id"
                                                                                        value="<?php echo e($p->product_variant_id); ?>">
                                                                                    <input type="hidden"
                                                                                        name="product_id"
                                                                                        value="<?php echo e($p->product_id); ?>">
                                                                                    <div
                                                                                        class="button-container col pr-0 my-1">
                                                                                        <button
                                                                                            class="cart-qty-minus button-minus"
                                                                                            type="button"
                                                                                            id="button-minus"
                                                                                            value="-">-</button>
                                                                                        <input
                                                                                            class="form-control qtyPicker"
                                                                                            type="number" name="qty"
                                                                                            data-min="1" min="1"
                                                                                            max="<?php echo e(intval(getMaxQty($p->item[0]))); ?>"
                                                                                            data-max="<?php echo e(intval(getMaxQty($p->item[0]))); ?>"
                                                                                            value="<?php echo e($p->qty); ?>"
                                                                                            readonly>
                                                                                        <button
                                                                                            class="cart-qty-plus button-plus"
                                                                                            type="button"
                                                                                            id="button-plus"
                                                                                            value="+">+</button>
                                                                                    </div>
                                                                                </form>
                                                                                <?php if(intval($p->qty) > 1): ?>
                                                                                <?php if(intval($p->item[0]->discounted_price)): ?>
                                                                                x<small class="text-muted">
                                                                                    <?php echo e(get_price($p->item[0]->discounted_price)); ?></small>
                                                                                <?php else: ?>
                                                                                x<small class="text-muted">
                                                                                    <?php echo e(get_price($p->item[0]->price)); ?></small>
                                                                                <?php endif; ?>
                                                                                <?php endif; ?>
                                                                            </figcaption>
                                                                        </figure>
                                                                    </a>
                                                                    <div class="price-wrap">
                                                                        <var class="price">
                                                                            <?php if(intval($p->item[0]->discounted_price)): ?>
                                                                            <?php echo e(get_price($p->item[0]->discounted_price * ($p->qty ?? 1) )); ?>

                                                                            <?php else: ?>
                                                                            <?php echo e(get_price($p->item[0]->price * ($p->qty ?? 1) )); ?>

                                                                            <?php endif; ?>
                                                                        </var>

                                                                    </div>

                                                                    <button
                                                                        class="btn btn-light btn-round btnEdit cartShow">
                                                                        <em class="fa fa-pencil-alt"></em></button>
                                                                    <button
                                                                        class="btn btn-light btn-round cartSave cartEdit">
                                                                        <em class="fas fa-check"></em></button>
                                                                    <button
                                                                        class="btn btn-light btn-round btnEdit cartEdit">
                                                                        <em class="fa fa-times"></em></button>
                                                                    <a href="<?php echo e(route('cart-remove', $p->product_variant_id )); ?>"
                                                                        class="btn btn-light btn-round"> <em
                                                                            class="fas fa-trash-alt"></em></a>
                                                                </td>


                                                            </tr>
                                                            <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                            <tr>
                                                                <td colspan="4" class="text-center">
                                                                    <img src="<?php echo e(asset('images/empty-cart.png')); ?>"
                                                                        alt="No Items In Cart">
                                                                    <br><br>
                                                                    <a href="<?php echo e(route('shop')); ?>"
                                                                        class="btn btn-primary"><em
                                                                            class="fa fa-chevron-left  mr-1"></em><?php echo e(__('msg.continue_shopping')); ?></a>
                                                                </td>
                                                            </tr>
                                                            <?php endif; ?>
                                                        </tbody>

                                                        <tfoot>
                                                            <tr>

                                                                <?php if(isset($data['cart']) && is_array($data['cart']) &&
                                                                count($data['cart'])): ?>

                                                                <td colspan="" class="text-right checkoutbtn">
                                                                    <a href="<?php echo e(route('cart-remove', 'all' )); ?>"
                                                                        class="btn btn-primary"><?php echo e(__('msg.delete_all')); ?>

                                                                        <em class="fa fa-trash"></em></a>
                                                                    <?php if(Cache::has('min_order_amount') &&
                                                                    intval($data['cart']['subtotal']) >=
                                                                    intval(Cache::get('min_order_amount'))): ?>
                                                                    <a href="<?php echo e(route('checkout')); ?>"
                                                                        class="btn btn-primary"><?php echo e(__('msg.checkout')); ?>

                                                                        <em class="fa fa-arrow-right"></em></a>
                                                                    <?php else: ?>
                                                                    <button class="btn btn-primary"
                                                                        disabled><?php echo e(__('msg.checkout')); ?> <em
                                                                            class="fa fa-arrow-right"></em></button>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td colspan="" class="text-right mini_cart-subtotal ">
                                                                        <?php if(isset($data['cart']['saved_price']) && floatval($data['cart']['saved_price'])): ?>
                                                                            <p class="product-name text-right"><?php echo e(__('msg.saved_price')); ?> : <span><?php echo e(get_price($data['cart']['saved_price'])); ?></span></p>

                                                                        <?php endif; ?>
                                                                </td>
                                                                <?php endif; ?>

                                                            </tr>

                                                        </tfoot>



                                                    </table>
                                                </div>
                                                <!--mini cart end-->
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            <div class="header_bottom sticky-header">
                <div class="container">
                    <div class="row align-items-center positionheader">
                        <div class="col-12 col-md-6 mobile_screen_block">
                            <div class="header_search">
                                <form action="#">
                                    <div class="header_hover_category">
                                        <?php
                                        $categories = Cache::get('categories', []);
                                        ?>
                                        <form action="<?php echo e(route('shop')); ?>">
                                            <select class="select_option">
                                                <option selected>Select Category</option>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e(route('category', $i)); ?>"><?php echo e($c->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                    </div>

                                    <div class="header_search_box">
                                        <input type="text" class="form-control"
                                            value="<?php echo e(isset($_GET['s']) ? trim($_GET['s']) : ''); ?>" name="s"
                                            placeholder="Search Product...">
                                        <button type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="header_categories_menu">
                                <?php
                                $categories = Cache::get('categories', []);
                                $maxProductToShow = 10;
                                $totalCategories = count($categories);
                                ?>

                                <div class="categories_title">
                                    <h2 class="category_toggle">All Categories</h2>
                                    <i class="fas fa-chevron-down fa-xs"></i>
                                </div>

                                <div class="header_categories_toggle">
                                    <ul>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(isset($c->childs) && count((array)$c->childs)): ?>
                                        <li class="header_menu_item <?php echo e($k >= $maxProductToShow ? 'hidden' : ''); ?>"><a
                                                href="<?php echo e(route('category', $k)); ?>"><?php echo e($c->name); ?><i
                                                    class="fas fa-plus fa-xs"></i></a>
                                            <ul class="header_categories_mega_menu">
                                                <?php $__currentLoopData = $c->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <li><a
                                                        href="<?php echo e(route('shop', ['category' => $c->slug, 'sub-category' => $child->slug])); ?>"><?php echo e($child->name); ?></a>
                                                </li>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </li>
                                        <?php else: ?>
                                        <li class="<?php echo e($k >= $maxProductToShow ? 'hidden' : ''); ?>"><a
                                                href="<?php echo e(route('category', $c->slug)); ?>"><?php echo e($c->name); ?></a></li>
                                        <?php endif; ?>
                                        <?php if(intval(--$maxProductToShow)): ?>
                                        <?php else: ?>
                                        <?php if($maxProductToShow == 0): ?>
                                        <li><a href="#" id="more-btn"><i class="fa fa-plus" aria-hidden="true"></i> More
                                                Categories</a>
                                        </li>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!--main menu start-->
                            <div class="main_menu header_menu_position">
                                <nav>
                                    <ul>
                                        <li><a class="active" href="<?php echo e(route('home')); ?>">Home</a>
                                            <!--<ul class="sub_menu">
                                                            <li><a href="#">Home shop 1</a></li>
                                                            <li><a href="#">Home shop 2</a></li>
                                                            <li><a href="#">Home shop 3</a></li>
                                                            <li><a href="#">Home shop 4</a></li>
                                                            <li><a href="#">Home shop 5</a></li>
                                                        </ul>-->
                                        </li>
                                        <li><a href="<?php echo e(route('shop')); ?>"> Shop</a></li>

                                        <li><a>More <em class="fas fa-chevron-down fa-xs"></em></a>
                                            <ul class="sub_menu">
                                                <li><a href="<?php echo e(route('page', 'about')); ?>">About Us</a></li>
                                                <li><a href="<?php echo e(route('page', 'faq')); ?>">FAQ</a></li>
                                                <?php if(isLoggedIn()): ?>
                                                <li><a href="<?php echo e(route('my-account')); ?>">My Account</a></li>
                                                <?php endif; ?>
                                            </ul>
                                        </li>

                                        <li><a href="<?php echo e(route('contact')); ?>"> Contact Us</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <!--main menu end-->
                        </div>
                        <div class="col-lg-3">
                            <?php if(trim(Cache::get('support_number', '')) != ''): ?>
                            <div class="header_call-support">
                                <p><a href="#"><?php echo e(Cache::get('support_number')); ?></a> Customer Support</p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </header>
    <div>
        <?php echo $__env->make("themes.".get('theme').".parts.breadcrumb", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make("themes.".get('theme').".common.msg", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <script src="<?php echo e(theme('js/plugins.js')); ?>"></script>
    <script src="<?php echo e(theme('js/home.js')); ?>"></script>
<?php /**PATH /home/thetricu/titalidesingerstudio.com/resources/views/themes/ekart/common/header.blade.php ENDPATH**/ ?>