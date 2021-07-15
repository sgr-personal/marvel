<section class="section-content padding-bottom footerfix">
    <a href="#" id="scroll"><span></span></a>
    <nav aria-label="breadcrumb" class="mt-5">
        <ol class="breadcrumb">
            <li class=" item-1"></li>
            <li class="breadcrumb-item"><a href="{{ route('my-account') }}">{{__('msg.my_account')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('msg.favourites')}}</li>
        </ol>
    </nav>
    <div class="container mt-5">
        @if(isset($data['list']['data']) && is_array($data['list']['data']) && count($data['list']['data']))
            <div class="row ekart spacingrm">
                @foreach($data['list']['data'] as $itm)
                    <div class="col-xl-2 col-lg-3 col-md-4 col-6 recent-add">
                        <figure class="card card-sm card-product-grid">
                            <aside class="add-to-fav">
                                <a type="button" class="btn" href="{{ route('favourite-remove', $itm->product_id) }}">
                                    <em class="fas fa-heart"></em>
                                </a>
                            </aside>
                            <a href="{{ route('product-single', $itm->slug) }}" class="img-wrap"> <img src="{{ $itm->image }}" alt="{{ $tim->name ?? 'Product Image' }}"> </a>
                            <figcaption class="info-wrap">
                                <div class="text-wrap p-3 text-left">
                                    <a href="{{ route('product-single', $itm->slug) }}" class="title font-weight-bold product-name mb-2">{{ $itm->name }}</a>

                                    <div class="price mt-1 ">
                                        <strong id="price_{{ $itm->id }}">{!! print_price($itm) !!}</strong> &nbsp; <s class="text-muted" id="mrp_{{ $itm->id }}">{!! print_mrp($itm) !!}</s>
                                        <small class="text-success" id="savings_{{ $itm->id }}"> {{ get_savings_varients($itm->variants[0]) }} </small>
                                    </div>
                                </div>
                            </figcaption>
                            <span class="inner">
                                <form action='{{ route('cart-add') }}' method="POST">
                                    <input type="hidden" name='id' value='{{ $itm->product_id }}'>
                                    <input type="hidden" name="type" value='add'>
                                    <input type="hidden" name="child_id" value='{{ $itm->variants[0]->id }}' id="child_{{ $itm->id }}">
                                    <select name="varient" data-id="{{ $itm->id }}">
                                        @foreach($itm->variants as $v)
                                            @if(intval($v->stock))
                                                <option value="{{ $v->id }}"  data-price='{{ get_price(get_price_varients($v)) }}' data-mrp='{{ get_price(get_mrp_varients($v)) }}' data-savings='{{ get_savings_varients($v) }}'>{{ get_varient_name($v) }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    <button type="submit" name="submit" class="btn fa fa-shopping-cart"><span>&nbsp;&nbsp;{{__('msg.add_to_cart')}}</span></button>
                                </form>
                            </span>
                        </figure>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row text-center">
                <div class="col-12">
                    <br><br>
                    <h3>{{__('msg.no_favorites_product_found')}}</h3>
                </div>
                <div class="col-12">
                    <br><br>
                    <a href="{{ route('shop') }}" class="btn btn-primary"><em class="fa fa-chevron-left mr-1"></em> {{__('msg.continue_shopping')}}</a>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col">
                @if(isset($data['last']) && $data['last'] != "")
                    <a href="{{ $data['last'] }}" class="btn btn-primary pull-left text-white"><em class="fa fa-arrow-left"></em> {{__('msg.previous')}}</a>
                @endif
            </div>
            <div class="col favnext text-right">
                @if(isset($data['next']) && $data['next'] != "")
                    <a href="{{ $data['next'] }}" class="btn btn-primary pull-right text-white">{{__('msg.next')}} <em class="fa fa-arrow-right"></em></a>
                @endif
            </div>
        </div>
    </div>
</section>