@include("themes.$theme.common.msg")
<section class="section-content footerfix padding-bottom">
    <a href="#" id="scroll"><span></span></a>
    <div class="container mt-5">
        <h2 class="mb-5 title-sec text-center">{{__('msg.shopping_cart')}}</h2>
        @if(Cache::has('min_order_amount') && intval($data['subtotal']) <= intval(Cache::get('min_order_amount')))
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="alert alert-warning">{{__('msg.you_must_have_to_purchase')}} {{ get_price(Cache::get('min_order_amount')) }} {{__('msg.to_place_order')}}</div>
                </div>
            </div>
        @elseif(intval(Cache::get('min_amount', 0)) && intval($data['shipping']))
            @if(intval($data['subtotal']) && intval($data['subtotal']) < Cache::get('min_amount'))
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="alert alert-info">{{__('msg.you_can_get_free_delivery_by_shopping_more_than')}} {{ get_price(Cache::get('min_amount')) }}</div>
                    </div>
                </div>
            @endif
        @endif
        <div class="row justify-content-center">
            <main class="col-md-9">
                <div class="card">
                    <div class="table-responsive">
                        <table id="myTable" class="table ">
                            <thead>
                                <tr class="cart1title">
                                    <th scope="col">{{__('msg.product')}}</th>
                                    <th scope="col">{{__('msg.qty')}}</th>
                                    <th scope="col">{{__('msg.price')}}</th>
                                    <th scope="col" class="text-right cartext"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($data['cart']) && is_array($data['cart']) && count($data['cart']))
                                    @foreach($data['cart'] as $p)
                                        @if(isset($p->item[0]))
                                            <tr class="cart1price">
                                                <td>
                                                    <a href="{{ route('product-single', $p->item[0]->slug) }}">
                                                        <figure class="itemside">
                                                            <div class="aside">
                                                                <img src="{{ $p->item[0]->image }}" class="img-sm" alt="{{ $p->item[0]->name ?? 'Product Image' }}">
                                                            </div>
                                                            <figcaption class="info">
                                                                <a href="{{ route('product-single', $p->item[0]->slug) }}" class="title text-dark">{{ $p->item[0]->name ?? '-' }}</a>
                                                                <p class="small text-muted">{{ get_varient_name($p->item[0]) ?? '-' }}</p>
                                                            </figcaption>
                                                        </figure>
                                                    </a>
                                                </td>
                                                <td class="cart">
                                                    <div class="price-wrap cartShow">{{ $p->qty }}</div>
                                                    <form action="{{ route('cart-update', $p->product_id) }}" method="POST" class="cartEdit">
                                                        @csrf
                                                        <input type="hidden" name="child_id" value="{{ $p->product_variant_id }}">
                                                        <input type="hidden" name="product_id" value="{{ $p->product_id }}">
                                                        <div class="button-container col">
                                                            <button class="cart-qty-minus button-minus" type="button" id="button-minus" value="-">-</button>
                                                            <input class="form-control qtyPicker" type="number" name="qty" data-min="1" min="1" max="{{ intval(getMaxQty($p->item[0])) }}" data-max="{{ intval(getMaxQty($p->item[0])) }}" value="{{ $p->qty }}" readonly>
                                                            <button class="cart-qty-plus button-plus" type="button" id="button-plus" value="+">+</button>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td>
                                                    <div class="price-wrap">
                                                        <var class="price">
                                                            @if(intval($p->item[0]->discounted_price))
                                                                {{ get_price($p->item[0]->discounted_price * ($p->qty ?? 1) ) }}
                                                            @else
                                                                {{ get_price($p->item[0]->price * ($p->qty ?? 1) ) }}
                                                            @endif
                                                        </var>
                                                        @if(intval($p->qty) > 1)
                                                            @if(intval($p->item[0]->discounted_price))
                                                                <br><small class="text-muted"> {{ get_price($p->item[0]->discounted_price) }}{{ ($p->qty > 0) ? ' each' : '' }}</small>
                                                            @else
                                                                <br><small class="text-muted"> {{ get_price($p->item[0]->price) }}{{ ($p->qty > 0) ? ' each' : '' }}</small>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="text-right checktrash">
                                                    <button class="btn btn-light btn-round btnEdit cartShow"> <em class="fa fa-pencil-alt"></em></button>
                                                    <button class="btn btn-light btn-round cartSave cartEdit"> <em class="fas fa-check"></em></button>
                                                    <button class="btn btn-light btn-round btnEdit cartEdit"> <em class="fa fa-times"></em></button>
                                                    <a href="{{ route('cart-remove', $p->product_variant_id ) }}" class="btn btn-light btn-round"> <em class="fas fa-trash-alt"></em></a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <img src="{{ asset('images/empty-cart.png') }}" alt="No Items In Cart">
                                        <br><br>
                                        <a href="{{ route('shop') }}" class="btn btn-primary"><em class="fa fa-chevron-left  mr-1"></em>{{__('msg.continue_shopping')}}</a>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                            @if(isset($data['cart']) && is_array($data['cart']) && count($data['cart']))
                                <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td class="text-right" colspan="2">
                                            <p class="product-name">{{__('msg.subtotal')}} : <span>{{ get_price($data['subtotal']) ?? '-' }}</span></p>
                                            @if(isset($data['tax_amount']) && floatval($data['tax_amount']))
                                                <p class="product-name">{{__('msg.tax')}} {{ $data['tax'] ? $data['tax']."%" : '' }} : <span>+ {{ get_price($data['tax_amount']) }}</span></p>
                                            @endif
                                            @if(isset($data['shipping']) && floatval($data['shipping']))
                                                <p class="product-name">{{__('msg.delivery_charge')}} : <span>+ {{ get_price($data['shipping']) }}</span></p>
                                            @endif
                                            @if(isset($data['coupon']['discount']) && floatval($data['coupon']['discount']))
                                                <p class="product-name">{{__('msg.discount')}} : <span>- {{ get_price($data['coupon']['discount']) }}</span></p>
                                            @endif
                                            <p class="product-name">{{__('msg.total')}} : <span> {{ get_price($data['total']) ?? '-' }}</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="continue-shopping"><strong><span><a href="{{ route('shop') }}" class="btn btn-primary"><em class="fa fa-chevron-left mr-1"></em>{{__('msg.continue_shopping')}}</a></span></strong></td>
                                        @if(isset($data['cart']) && is_array($data['cart']) && count($data['cart']))
                                            <td></td>
                                            <td colspan="2" class="text-right checkoutbtn">
                                                <a href="{{ route('cart-remove', 'all' ) }}" class="btn btn-primary">{{__('msg.delete_all')}} <em class="fa fa-trash"></em></a>
                                                @if(Cache::has('min_order_amount') && intval($data['subtotal']) >= intval(Cache::get('min_order_amount')))
                                                    <a href="{{ route('checkout') }}" class="btn btn-primary">{{__('msg.checkout')}} <em class="fa fa-arrow-right"></em></a>
                                                @else
                                                    <button class="btn btn-primary" disabled>{{__('msg.checkout')}} <em class="fa fa-arrow-right"></em></button>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</section>