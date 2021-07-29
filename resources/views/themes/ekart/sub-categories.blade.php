<section class="footerfix section-content padding-bottom">
    <a href="#" id="scroll"><span></span></a>
    <div class="container category_desc" style="margin-bottom: 20px;">
        {!! $data['category']->description !!}
    </div>
    <div class="container">
        <nav class="row row-eq-height">
            @if(isset($data['sub-categories']))
            @foreach ($data['sub-categories'] as $c)
            <div class="col-md-3 mt-2">
                <a href="{{ route('shop', ['category' => $data['category']->slug, 'sub-category' => $c->slug]) }}">
                    <div class="card card-category eq-height-element">
                        <div class="img-wrap">
                            <img src="{{ $c->image }}" alt="{{ $c->name ?? '' }}">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">{{ $c->name }}</h4>
                            <p>{{ $c->subtitle }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            @else
            <div class="row">
                <div class="col">
                    <br><br>
                    <h1 class="text-center">{{__('msg.no_subcategory_found')}}</h1>
                </div>
            </div>
            @endif
        </nav>
    </div>
</section>
