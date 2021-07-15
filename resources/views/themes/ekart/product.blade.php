<!-- product detail page -->
<div class="section-content mt-5">
    <a href="#" id="scroll"><span></span></a>
    <div class="container mt-5 padding-bottom">
        <div class="card pb-4 mt-5">
            <!--Grid row-->
            <div class="row mt-5">
                <!--Grid column-->
                <div class="col-lg-6 col-md-12 col-12 pics text-center productdetails1">
                    @php $count=1; @endphp
                    <div class="wrap-gallery-article">
                        <div id="myCarouselArticle" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#myCarouselArticle" data-slide-to="0" {{ $count == 0 ? 'class="active"' : ''}}></li>
                                @if(isset($data['product']->other_images) && is_array($data['product']->other_images) && count($data['product']->other_images))
                                    @foreach($data['product']->other_images as $index => $img)
                                        <li data-target="#myCarouselArticle" data-slide-to="{{$count}}"></li>
                                    @php $count++; @endphp
                                    @endforeach
                                @endif
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <img class="outerdetailimg" src="{{ $data['product']->image }}" alt="{{ $data['product']->name ?? 'Product Image' }}">
                                </div>
                                @if(isset($data['product']->other_images) && is_array($data['product']->other_images) && count($data['product']->other_images))
                                    @foreach($data['product']->other_images as $index => $img)
                                    <div class="carousel-item">
                                        <img class="outerdetailimg" src="{{ $img }}" alt="{{ $data['product']->name ?? 'Product Image' }}">
                                    </div>
                                    @endforeach
                                @endif
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
                                        <img class="img-fluid" src="{{ $data['product']->image }}" alt="{{ $data['product']->name ?? 'Product Image' }}">
                                    </a>
                                </li>
                                @php $count=1; @endphp
                                @foreach($data['product']->other_images as $index => $img)
                                    <li class="col-sm-3 col-3 thumb-gallery-smallimg">
                                        <a class="thumbnail thumbnailimg" data-target="#myCarouselArticle" data-slide-to="{{$count}}">
                                            <img class="img-fluid" src="{{$img}}" alt="{{ $data['product']->name ?? 'Product Image' }}">
                                        </a>
                                    </li>
                                @php $count++; @endphp
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-lg-6 col-md-12 col-12 productdetails2 ">
                    <aside class="add-to-fav">
                        <button type="button" class="btn {{ (isset($data['product']->is_favorite) && intval($data['product']->is_favorite)) ? 'saved' : 'save' }}" data-id='{{ $data['product']->id }}' />
                    </aside>
                    <!--Content-->
                    <div class="text-left">
                        <p class="lead title-sec font-weight-bold">{{ $data['product']->name ?? '-' }}</p>
                        <p></p>
                        <hr class="line1 ml-0">
                        <p class="mt-2 read-more desc">@if(strlen($data['product']->description) > 200) {!! substr($data['product']->description, 0,200) ."..." !!} @else {!! substr($data['product']->description, 0,200) !!} @endif
                            @if(strlen($data['product']->description) > 200)
                                <a class="more-content" href="#desc" id="description">{{__('msg.read_more')}}</a>
                            @endif
                        </p>
                        @if(count(getInStockVarients($data['product'])))
                            <hr class="line1 ml-0">
                            <p class="text-muted" id="price_mrp_{{ $data['product']->id }}"><del>{{__('msg.price')}}: <span class='value'></span></del></p>
                            <h5 class="font-weight-bold title-sec" id="price_offer_{{ $data['product']->id }}">{{__('msg.offer_price')}}: {{ Cache::get('currency') }} <span class='value'></span></h5>
                            <h5 class="font-weight-bold" id="price_regular_{{ $data['product']->id }}">{{__('msg.price')}}: <span class='value'></span></h5>
                            <small class="text-primary" id="price_savings_{{ $data['product']->id }}">{{__('msg.you_save')}}: {{ Cache::get('currency') }} <span class='value'></span></small>
                            <div class="form">
                                <form action="{{ route('cart-add') }}" class="addToCart" method="POST">
                                    @csrf
                                    <input type="hidden" name='id' value='{{ $data['product']->id }}'>
                                    <input type="hidden" name="type" value='add'>
                                    <input type="hidden" name="child_id" value='0' id="child_{{ $data['product']->id }}">
                                    <div class="row mt-4">
                                        <div class="button-container col">
                                            <button class="cart-qty-minus button-minus" type="button" id="button-minus" value="-">-</button>
                                            <input class="form-control qtyPicker" id="qtyPicker_{{ $data['product']->id }}" type="number" name="qty" data-min="0" min="1" max="1" data-max="1" value="1" readonly>
                                            <button class="cart-qty-plus button-plus" type="button" id="button-plus" value="+">+</button>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="form-group col">
                                            <div class="btn-group-toggle variant" data-toggle="buttons">
                                                @php $firstSelected = true; @endphp
                                                @foreach(getInStockVarients($data['product']) as $v)
                                                    <button class="btn" data-id="{{ $data['product']->id }}">
                                                        <span class="text-dark name">{{ get_varient_name($v) }}</span><br>
                                                        <small> {{__('msg.option_from')}} {{ get_price_varients($v) }}</small>
                                                        <input type="radio" name="options" id="option{{ $v->id }}" value="{{ $v->id }}" data-id='{{ $v->id }}' data-price='{{ get_price_varients($v) }}' data-mrp='{{ get_mrp_varients($v) }}' data-savings='{{ get_savings_varients($v, false) }}' data-stock='{{ intval(getMaxQty($v)) }}' autocomplete="off" >
                                                    </button>
                                                    @if($firstSelected == true)
                                                        {{ $firstSelected = false }}
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        @if(intval($data['product']->indicator) == 2)
                                            <img src="{{ asset('images/nonvag.svg') }}" alt="Not Vegetarian Product">
                                            <span class="text-left ml-1"> {{__('msg.not')}} <strong>{{__('msg.vegetarian')}}</strong> {{__('msg.v_product')}}.</span>
                                        @elseif(intval($data['product']->indicator) == 1)
                                            <img src="{{ asset('images/vag.svg') }}" alt="Vegetarian Product">
                                            <span class="text-left ml-1"> {{__('msg.this_is')}} <strong>{{__('msg.vegetarian')}}</strong> {{__('msg.v_product')}}.</span>
                                        @endif
                                    </div>
                                    <div class="form-group text-left add-to-cart1">
                                        <button type="submit" name="submit" class="btn">
                                            <em class="fa fa-shopping-cart"> <span class="text-uppercase ml-2">{{__('msg.add_to_cart')}}</span></em>
                                        </button>
                                        <button class="buy-now btn btn-primary text-center text-uppercase text-white" type="submit" name="submit" value="buynow"> <span class="buy-now1">{{__('msg.buy_now')}}</span></button>
                                    </div>
                                </form>
                            </div>
                        @else
                            <span class="sold-out">{{ __('msg.sold_out') }}</span>
                        @endif
                         <div class="row card-content text-center policycontent">
                    @if(isset($data['product']->return_status))
                        <div class="card productcard p-3 col-12 col-md-6 col-lg-4 returnpolicy">
                            @if(intval($data['product']->return_status))
                                <div class="card-img pb-3">
                                    <span class="creativity">
                                        <img src="{{ asset('images/returnable.png') }}" alt="Returnable">
                                    </span>
                                </div>
                                <div class="card-box">
                                    <h6 class="card-title py-3 text-center">{{ Cache::get('max-product-return-days') }}  {{__('msg.days')}} {{__('msg.returnable')}}</h6>

                                </div>
                            @else
                                <div class="card-img pb-3">
                                    <span class="creativity">
                                        <img src="{{ asset('images/not-returnable.svg') }}" alt="notReturnable">
                                    </span>
                                </div>
                                <div class="card-box">
                                    <h6 class="card-title py-3 text-center">{{__('msg.not_returnable')}}</h6>

                                </div>
                            @endif
                        </div>
                    @endif

                    @if(isset($data['product']->cancelable_status))
                        <div class="card productcard p-3 col-12 col-md-6 col-lg-4 returnpolicy">
                            @if(intval($data['product']->cancelable_status))
                                <div class="card-img pb-3">
                                    <span class="creativity">
                                        <img src="{{ asset('images/cancellable.png') }}" alt="Cancellable">
                                    </span>
                                </div>
                                <div class="card-box">
                                    <h6 class="card-title py-3 text-center">{{__('msg.order_can_cancel_till_order')}} {{ strtoupper($data['product']->till_status ?? '') }}</h6>

                                </div>
                            @else
                                <div class="card-img pb-3">
                                    <span class="creativity">
                                        <img src="{{ asset('images/not-cancellable.svg') }}" alt="notCancellable">
                                    </span>
                                </div>
                                <div class="card-box">
                                    <h6 class="card-title py-3 text-center">{{__('msg.not_cancellable')}}</h6>

                                </div>
                            @endif
                        </div>
                    @endif

                </div>
                   </div>
                </div>
            </div>



                {{-- return and cancelable --}}
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
                            <a class="nav-link active product-info title-sec" href="#desc" role="tab" data-toggle="tab">{{__('msg.product_details')}}</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content box rounded product-info-tab">
                            <div role="tabpanel" class="tab-pane active bg-white text-dark" id="desc">{!! $data['product']->description !!}</div>
                        </div>

                        <div class="m-2">
                            @if(isset($data['product']->manufacturer) && trim($data['product']->manufacturer) != "")
                                <p>{{__('msg.manufacturer')}} : {{ $data['product']->manufacturer }}</p>
                            @endif
                            @if(isset($data['product']->made_in) && trim($data['product']->made_in) != "")
                                <p>{{__('msg.made_in')}} : {{ $data['product']->made_in }}</p>
                            @endif
                        </div>

                    </div>
                </div>




        <!--similar product-content-->
        @if(isset($data['similarProducts']) &&  !empty($data['similarProducts']))
            <section class="section-content padding-bottom mt-3 sellpro similarpro">

                <h4 class="title-sec font-weight-bold">{{__('msg.similar_products')}}
                    <a href="{{ route('shop') }}" class="view title-section viewall">{{__('msg.view_all')}}</a>
                <hr class="line">

                <div class="ekart">
                <div class="row no-gutter">
                @php   $maxProductShow = get('style_2.max_product_on_homne_page'); @endphp
                @foreach($data['similarProducts'] as $p)
                    @if((--$maxProductShow) > -1)
                        <div class="col-xl-2 col-lg-3 col-md-4 col-6 recent-add">
                            <figure class="card card-sm card-product-grid">
                                <aside class="add-to-fav">
                                    <button type="button" class="btn {{ (isset($p->is_favorite) && intval($p->is_favorite)) ? 'saved' : 'save' }}" data-id='{{ $p->id }}' />
                                </aside>
                                <a href="{{ route('product-single', $p->slug) }}" class="img-wrap"> <img src="{{ $p->image }}" alt="{{ $p->name ?? 'Product Image' }}"> </a>
                                <figcaption class="info-wrap">
                                    <div class="text-wrap p-3 text-left">
                                        <a href="{{ route('product-single', $p->slug) }}" class="title font-weight-bold product-name">{{ $p->name }}</a>

                                        <span class="text-muted style-desc">
                                            @if(strlen(strip_tags($p->description)) > 20) {!! substr(strip_tags($p->description), 0,20)."..." !!} @else {!! substr(strip_tags($p->description), 0,20) !!} @endif
                                        </span>
                                        <div class="price mt-1 ">
                                            <strong id="price_{{ $p->id }}">{!! print_price($p) !!}</strong> &nbsp; <s class="text-muted" id="mrp_{{ $p->id }}">{!! print_mrp($p) !!}</s>
                                            <small class="text-success" id="savings_{{ $p->id }}"> {{ get_savings_varients($p->variants[0]) }} </small>
                                        </div>
                                    </div>
                                </figcaption>
                                @if(count(getInStockVarients($p)))
                                    <span class="inner">
                                        <form action='{{ route('cart-add-single-varient') }}' method="POST">
                                            <input type="hidden" name="id" value="{{ $p->id }}">
                                            <select name="varient" data-id="{{ $p->id }}">
                                                @foreach(getInStockVarients($p) as $v)
                                                    <option value="{{ $v->id }}"  data-price='{{ get_price(get_price_varients($v)) }}' data-mrp='{{ get_price(get_mrp_varients($v)) }}' data-savings='{{ get_savings_varients($v) }}'>{{ get_varient_name($v) }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn cart-1 fa fa-shopping-cart"><span>&nbsp;&nbsp;{{__('msg.add_to_cart')}}</span></button>
                                        </form>
                                    </span>
                                @else
                                    <span class="sold-out">{{ __('msg.sold_out') }}</span>
                                @endif
                            </figure>
                        </div>
                    @endif
                @endforeach
            </div>
            </div>
            </section>
        @endif
        <!--end similar product content-->
    </div>

</div>
<!-- end product detail page -->