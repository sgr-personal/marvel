
@include("themes.$theme.common.msg")
<section class="section-content footerfix padding-bottom mt-5">
    <a href="#" id="scroll"><span></span></a>
    <div class="container">
        <div class="card shadow-sm mb-4">
            <div class="row">
                <div class="col-md-4 col-4 text-center">
                    <span class="icon dark"><em class="fa fa-chevron-circle-right delivery-icon"></em> {{__('msg.delivery')}}</span>
                </div>
                <div class="col-md-4 col-4 text-center payment-icon">
                    <span class="icon dark"><em class="fa fa-chevron-circle-right"></em> {{__('msg.address')}}</span>
                </div>
                <div class="col-md-4 col-4 text-center payment-icon">
                    <span class="icon dark"><em class="fa fa-chevron-circle-right"></em> {{__('msg.payment')}}</span>
                </div>
            </div>
        </div>
        <main>
            <div class="row" id="delivery">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            @if(intval($data['coupon'] ?? 0))
                                <div class="form-group" id='couponAppliedDiv'>
                                    <label class="title-sec">{{__('msg.coupon_code')}}</label>
                                    <div class="alert alert-success">{{ $data['coupon']['promo_code_message'] }}</div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ $data['coupon']['promo_code'] }}" disabled="disabled" placeholder="Coupon code">
                                        <span class="input-group-append">
                                            <a href="{{ route('coupon-remove') }}" class="btn btn-danger" id='removeCoupon'>x</a>
                                        </span>
                                    </div>
                                </div>
                            @endif
                            <form action="{{ route('coupon-apply') }}" method="POST" class='ajax-form {{ intval($data['coupon'] ?? 0) ? 'address-hide' : '' }}' id='couponForm'>
                                <input type="hidden" name="total" value="{{ $data['total'] }}">
                                <div class="form-group">
                                    <label class="title-sec">{{__('msg.have_a_promo_code')}}</label>
                                    <div class='formResponse'></div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="coupon" value="{{ $data['coupon']['promo_code'] ?? '' }}" placeholder="Coupon code">
                                        <span class="input-group-append">
                                            <button class="btn btn-primary">{{__('msg.apply')}}</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="summary">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="table-responsive">
                            <p class="product-name title-sec pb-0 font-weight-bold head" id="myDec">{{__('msg.order_summary')}}</p>
                            <table id="myTable" class="table" aria-describedby="myDec">
                                <thead>
                                    <tr class="checkout1title">
                                        <th scope="col">{{__('msg.product')}}</th>
                                        <th scope="col">{{__('msg.qty')}}</th>
                                        <th scope="col">{{__('msg.price')}}</th>
                                        <th scope="col">{{__('msg.subtotal')}}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if(isset($data['cart']) && is_array($data['cart']) && count($data['cart']))

                                        @foreach($data['cart'] as $p)

                                            @if(isset($p->item))

                                                <tr>
                                                    <td>
                                                        <a href="#">
                                                            <div class="product-img">
                                                                <figcaption class="info-wrap">
                                                                    <a href="#" class="product-name text-dark">{{ strtoupper($p->item[0]->name) ?? '-' }}</a>
                                                                    <p class="small text-muted">{{ get_varient_name($p->item[0]) }}<br>{{ __('msg.tax')." (".$p->item[0]->tax_percentage }}%)</p>
                                                                </figcaption>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td>{{ $p->qty }}</td>
                                                    <td>
                                                        @if(intval($p->item[0]->discounted_price))
                                                            {{ $p->item[0]->discounted_price ?? '' }}
                                                        @else
                                                            {{ $p->item[0]->price ?? '' }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(intval($p->item[0]->discounted_price))
                                                            {{ $p->item[0]->discounted_price * ($p->qty ?? 1) }}
                                                        @else
                                                            {{ $p->item[0]->price * ($p->qty ?? 1) }}
                                                        @endif
                                                    </td>
                                                </tr>

                                            @endif

                                        @endforeach

                                    @endif

                                    <tfoot class="text-right">
                                        <tr class="mr-5">
                                            <td colspan="4">
                                                <p class="product-name">{{__('msg.subtotal')}} : <span>{{ get_price($data['subtotal'] ?? '-') }}</span></p>
                                                @if(isset($data['tax_amount']) && floatval($data['tax_amount']))
                                                    <p class="product-name">{{__('msg.tax')}} {{ $data['tax'] ? $data['tax']."%" : '' }} : <span>+ {{ get_price($data['tax_amount']) }}</span></p>
                                                @endif
                                                @if(isset($data['shipping']) && floatval($data['shipping']))
                                                    <p class="product-name">{{__('msg.delivery_charge')}} : <span>+ {{ get_price($data['shipping']) }}</span></p>
                                                @endif
                                                @if(isset($data['saved_price']) && floatval($data['saved_price']))
                                                    <p class="product-name">{{__('msg.saved_price')}} : <span>{{ get_price($data['saved_price']) }}</span></p>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="text-left">
                                            <td>
                                                <strong>
                                                    <p class="checkout-total">{{__('msg.total')}} : <span>{{ get_price($data['total']) }}</span></p>
                                                </strong>
                                            </td>

                                            <td colspan="2"></td>
                                            <td class="text-right">
                                                <strong>
                                                    <span>
                                                        <a href='{{ route('checkout-address') }}' class="btn btn-primary text-uppercase add-to-cart">{{__('msg.confirm')}} <em class="fa fa-check"></em></a>
                                                    </span>
                                                </strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</section>
