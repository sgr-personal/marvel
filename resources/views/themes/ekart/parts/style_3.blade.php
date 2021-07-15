

@if(isset($s->products) && is_array($s->products) && count($s->products))
    <!---section polular categories-->
    <section class="section-content padding-bottom ekartspec">
        <div class="container">
            <h4 class="title-section title-sec font-weight-bold">{{ $s->title }} <small class="text-muted short-desc">{{ $s->short_description }}</small></h4>
            @if(isset($s->slug) && $s->slug != "")
                <a href="{{ route('shop', ['section' => $s->slug]) }}" class="view  title-section viewall">{{__('msg.view_all')}}</a>
            @endif
            <hr class="line">
            <div class="row respondiv">
                @php $maxProductShow = get('style_3.max_product_on_homne_page'); @endphp
                @foreach($s->products as $p)
                    @if((--$maxProductShow-1) > -1)
                        <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="card-popular-category">
                                <a href="{{ route('product-single', $p->slug) }}">
                                <div class="col-4">
                                    <img class="rounded" src="{{ $p->image }}" alt="{{ $p->name ?? 'Product Name'}}">
                                </div>
                                </a>
                                <div class="col-8">
                                    <div class="text-wrap p-2 text-left">
                                        <a href="{{ route('product-single', $p->slug) }}" class="title font-weight-bold product-name">{{ $p->name }}</a>
                                        <span class="text-muted">@if(strlen(strip_tags($p->description)) > 60) {!! substr(strip_tags($p->description), 0,60)."..." !!} @else {!! substr(strip_tags($p->description), 0,60) !!} @endif</span>
                                        <div class="price mt-1 ">
                                            <strong>{!! print_price($p) !!}</strong>&nbsp; <s class="text-muted">{!! print_mrp($p) !!}</s>
                                            <small class="text-success ml-3"> {{ get_savings_varients($p->variants[0]) }} </small>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!---end section categories-->
@endif