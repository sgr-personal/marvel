<!--shop page -->
<section class="section-content padding-bottom mt-5">
    <a href="#" id="scroll"><span></span></a>
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-4 col-xl-3 col-12 filter mb-3">
                <div class="card">
                    <div class="pt-4">
                        <legend class="mb-1 p-0 title-sec">{{__('msg.filter_by')}}</legend>
                        <hr class="line mb-0 pb-0">
                    </div>
                    <form action='#' method="GET" id='filter'>
                        <input type="hidden" name="s" value="{{ isset($_GET['s']) ? trim($_GET['s']) : ''}}">
                        <input type="hidden" name="section"
                               value="{{ isset($_GET['section']) ? trim($_GET['section']) : ''}}">
                        <input type="hidden" name="category"
                               value="{{ isset($_GET['category']) ? trim($_GET['category']) : ''}}">
                        <input type="hidden" name="sub-category"
                               value="{{ isset($_GET['sub-category']) ? trim($_GET['sub-category']) : ''}}">
                        <input type="hidden" name="attribute-id"
                               value="{{ isset($_GET['attribute-id']) ? trim($_GET['attribute-id']) : ''}}">
                        <input type="hidden" name="attribute-value"
                               value="{{ isset($_GET['attribute-value']) ? trim($_GET['attribute-value']) : ''}}">
                        <input type="hidden" name="sort" value="{{ isset($_GET['sort']) ? trim($_GET['sort']) : ''}}">
                        <div>
                            <br>
                            <h5 class="mb-3 name title-sec">{{__('msg.price')}}</h5>
                            <div class="row">
                                <div class="col">
                                    <div id="slider-range" data-min="{{ intval($data['min_price']) }}"
                                         data-max="{{ intval($data['max_price']) + 1 }}"
                                         data-selected-min="{{ intval($data['selectedMinPrice']) }}"
                                         data-selected-max="{{ intval($data['selectedMaxPrice'])+1 }}"></div>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="number" name="min_price"
                                           value="{{ intval($data['selectedMinPrice']) }}" class="form-control">
                                </div>
                                <div class="col">
                                    <input type="number" name="max_price"
                                           value="{{ intval($data['selectedMaxPrice'])+1 }}" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <br>
                                    <button type="submit" name="submit"
                                            class="btn btn-primary btn-block">{{__('msg.filter')}}</button>
                                </div>
                            </div>
                        </div>
                        <br>
                    </form>
                    <br>
                    @if(isset($data['categories']) && is_array($data['categories']) && count($data['categories']))
                        <div>
                            <h5 class="mb-3 name title-sec">{{__('msg.category')}}</h5>
                            <div class="text ml-4 ">
                                @foreach($data['categories'] as $c)
                                    @if(isset($c->name) && trim($c->name) != "")
                                        <div class="custom-control custom-checkbox pb-2">
                                            <input type="checkbox" class="custom-control-input cats"
                                                   id="cat-{{ $c->id }}"
                                                   value="{{ $c->slug }}" {{ (isset($data['selectedCategory']) && is_array($data['selectedCategory']) && in_array($c->slug, $data['selectedCategory'])) ? 'checked' : ''}}>
                                            <label class="custom-control-label"
                                                   for="cat-{{ $c->id }}">{{ $c->name }}</label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if(isset($data['selectedCategory']) && is_array($data['selectedCategory']))
                        @foreach($data['selectedCategory'] as $cat)
                            @if(isset(Cache::get('categories',[])[$cat]) && isset(Cache::get('categories',[])[$cat]->childs) && !empty(Cache::get('categories',[])[$cat]->childs))
                                <br>
                                <div>
                                    <h5 class="mb-3 name">{{ Cache::get('categories',[])[$cat]->name }}</h5>
                                    <div class="text ml-4">
                                        @foreach(Cache::get('categories',[])[$cat]->childs as $c)
                                            <div class="custom-control custom-checkbox pb-2">
                                                <input type="checkbox" class="custom-control-input subs"
                                                       id="sub-{{ $c->id }}"
                                                       value="{{ $c->slug }}" {{ (isset($data['selectedSubCategory']) && is_array($data['selectedSubCategory']) && in_array($c->slug, $data['selectedSubCategory'])) ? 'checked' : ''}}>
                                                <label class="custom-control-label"
                                                       for="sub-{{ $c->id }}">{{ $c->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                    @if(isset($data['selectedSubCategory']) && is_array($data['selectedSubCategory']))
                        @foreach($data['selectedSubCategory'] as $sub_cat)
                            @if(isset(Cache::get('sub-categories',[])[$sub_cat]->attributes) && !empty(Cache::get('sub-categories',[])[$sub_cat]->attributes))
                                <br>
                                <div>
                                    <h5 class="mb-3 name">{{ Cache::get('sub-categories',[])[$sub_cat]->name }}</h5>
                                    <div class="text ml-4">
                                        @foreach(Cache::get('sub-categories',[])[$sub_cat]->attributes as $attributes)
                                            <div class="custom-control custom-checkbox pb-2">
                                                <input type="checkbox" class="custom-control-input attrs"
                                                       id="attr-{{ $attributes->id }}"
                                                       value="{{ $attributes->slug }}" {{ (isset($data['selectedAttrs']) && is_array($data['selectedAttrs']) && in_array($attributes->slug, $data['selectedAttrs'])) ? 'checked' : ''}}>
                                                <label class="custom-control-label"
                                                       for="attr-{{ $attributes->id }}">{{ $attributes->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                    @if(isset($data['selectedAttrs']) && is_array($data['selectedAttrs']))
                        @foreach($data['selectedAttrs'] as $attr)
                            @if(isset($data['attributes']) && isset($data['attributes'][$attr]->values))
                                <br>
                                <div>
                                    <h5 class="mb-3 name">{{ $data['attributes'][$attr]->name }}</h5>
                                    <div class="text ml-4">
                                        @foreach($data['attributes'][$attr]->values as $attr_values)
                                            <div class="custom-control custom-checkbox pb-2">
                                                <input type="checkbox" class="custom-control-input attr_values"
                                                       id="attr-value-{{ $attr_values->id }}"
                                                       value="{{ $attr_values->slug }}" {{ (isset($data['selectedAttrValues']) && is_array($data['selectedAttrValues']) && in_array($attr_values->slug, $data['selectedAttrValues'])) ? 'checked' : ''}}>
                                                <label class="custom-control-label"
                                                       for="attr-value-{{ $attr_values->id }}">{{ $attr_values->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                    <br>
                </div>
            </div>
            <div class="col-md-8 col-xl-9 col-lg-7 col-12 shopdetails">
                <nav class="navbar navbar-md navbar-light bg-white row gridviewdiv">
                    <div class="col-md-6 col-xs-3 col-6">
                        <div class="row">
                            <div id="list">
                                <em class="fa fa-list fa-lg" data-view="list-view"></em>
                            </div>
                            <div id="grid">
                                <em class="selected fa fa-th fa-lg" data-view="grid-view"></em>
                            </div>
                            @php
                                $number = 0;
                            @endphp
                            @if(isset($data['list']) && isset($data['list']['data']) && is_array($data['list']['data']) && count($data['list']['data']))
                                @foreach($data['list']['data'] as $p)
                                    <?php $number++ ?>
                                @endforeach
                            @endif
                            <div class="letter">
                                <small> {{ $number.' Items out of ' }}{{ (isset($data['total']) && intval($data['total'])) ?  $data['total'].' Items' : '' }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="gridviewselect">
                            <div class="row">
                                <div class="select"> {{__('msg.sort_by')}}:</div>
                                <div class="select1">
                                    <select class="form-control innerselect1" id="sort">
                                        <option value=""> {{__('msg.relevent')}} </option>
                                        <option
                                            value="new" {{ (isset($_GET['sort']) && $_GET['sort'] == 'new') ? 'selected' : '' }}>{{__('msg.new')}}</option>
                                        <option
                                            value="old" {{ (isset($_GET['sort']) && $_GET['sort'] == 'old') ? 'selected' : '' }}>{{__('msg.old')}}</option>
                                        <option
                                            value="low" {{ (isset($_GET['sort']) && $_GET['sort'] == 'low') ? 'selected' : '' }}>{{__('msg.low_to_high')}}</option>
                                        <option
                                            value="high" {{ (isset($_GET['sort']) && $_GET['sort'] == 'high') ? 'selected' : '' }}>{{__('msg.high_to_low')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
                @if(isset($data['list']) && isset($data['list']['data']) && is_array($data['list']['data']) && count($data['list']['data']))
                    <div id="products" class="row view-group">
                        @foreach($data['list']['data'] as $p)
                            @if(count($p->variants))
                                <div class="item1 col-sm-12 col-lg-6 col-md-4">
                                    <div class="add-to-fav">
                                        <button type="button"
                                                class="btn {{ (isset($p->is_favorite) && intval($p->is_favorite)) ? 'saved' : 'save' }}"
                                                data-id='{{ $p->id }}'/>
                                    </div>
                                    <a href="{{ route('product-single', $p->slug ?? '-') }}">
                                        <div class="thumbnail card-sm">
                                            <a href="{{ route('product-single', $p->slug ?? '-') }}">
                                                <div class="img-event">
                                                    <img class="group list-group-image img-fluid" src="{{ $p->image }}"
                                                         alt="{{ $p->image }}">
                                                </div>
                                            </a>
                                            <div class="caption card-body">
                                                <div class="text-wrap text-left">
                                                    <a href="{{ route('product-single', $p->slug ?? '-') }}"
                                                       class="title font-weight-bold product-name">{{ $p->name }}</a>

                                                    <span
                                                        class="text-muted description1">@if(strlen(strip_tags($p->description)) > 18) {!! substr(strip_tags($p->description), 0,18) ."..." !!} @else {!! substr(strip_tags($p->description), 0,18) !!} @endif</span>
                                                    <div class="price mt-1 ">
                                                        <strong id="price_{{ $p->id }}">{!! print_price($p) !!}</strong>
                                                        &nbsp; <s class="text-muted"
                                                                  id="mrp_{{ $p->id }}">{!! print_mrp($p) !!}</s>
                                                        <small class="text-success"
                                                               id="savings_{{ $p->id }}"> {{ get_savings_varients($p->variants[0]) }} </small>
                                                    </div>
                                                </div>
                                                @if(count(getInStockVarients($p)))
                                                    <span class="inner">
                                        <form action='{{ route('cart-add-single-varient') }}' method="POST">
                                            <input type="hidden" name="id" value="{{ $p->id }}">
                                            <select name="varient" data-id="{{ $p->id }}">
                                                @foreach(getInStockVarients($p) as $v)
                                                    <option value="{{ $v->id }}"
                                                            data-price='{{ get_price(get_price_varients($v)) }}'
                                                            data-mrp='{{ get_price(get_mrp_varients($v)) }}'
                                                            data-savings='{{ get_savings_varients($v) }}'>{{ get_varient_name($v) }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn cart-1 fa fa-shopping-cart"><span>&nbsp;&nbsp;{{__('msg.add_to_cart')}}</span></button>
                                        </form>
                                    </span>
                                                @else
                                                    <span class="sold-out">{{ __('msg.sold_out') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col"><br></div>
                    </div>
                    <div class="row">
                    <!-- <div class="col">
                         @if(isset($data['last']) && $data['last'] != "")
                        <a href="{{ $data['last'] }}" class="btn btn-primary pull-left text-white"><em class="fa fa-arrow-left"></em> {{__('msg.previous')}}</a>
                         @endif
                        </div>
                        <div class="col text-right">
@if(isset($data['next']) && $data['next'] != "")
                        <a href="{{ $data['next'] }}" class="btn btn-primary pull-right text-white">{{__('msg.next')}} <em class="fa fa-arrow-right"></em></a>
                         @endif
                        </div>-->
                        <div class="col text-right shoppagination">
                            @php
                                $number_of_pages = $data['number_of_pages'] + 1;
                                $currentpage = '0';
                                $currentpage = request()->input('page');
                            @endphp
                            @for($page = max(1, $currentpage - 2); $page <= min($currentpage + 4, $number_of_pages); $page++)

                                @php $pageprevious = $page-1;
                                @endphp
                                @if(request()->query('min_price')!== NULL)
                                    <a href="{{Request::fullUrl()}}&page={{ $pageprevious }}"
                                       @if($currentpage == $pageprevious ) class="active"
                                       @else class="btn btn-primary pull-right text-white" @endif> {{ $page }} </a>
                                @else
                                    <a href="shop?page={{ $pageprevious }}"
                                       @if($currentpage == $pageprevious ) class="active"
                                       @else class="btn btn-primary pull-right text-white" @endif>{{ $page }}  </a>
                                @endif
                            @endfor

                        </div>

                        @else
                            <div class="row">
                                <div class="col">
                                    <br><br>
                                    <h1 class="text-center">{{__('msg.no_product_found')}}</h1>
                                </div>
                            </div>
                        @endif
                    </div>

            </div>
        </div>
    </div>
</section>
<!-- End shop page -->
