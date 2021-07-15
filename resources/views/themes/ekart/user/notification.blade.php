<section class="section-content footerfix padding-bottom">
    <a href="#" id="scroll"><span></span></a>
    <nav aria-label="breadcrumb" class="mt-5"> 
        <ol class="breadcrumb">
            <li class=" item-1"></li>
            <li class="breadcrumb-item"><a href="{{ route('my-account') }}">{{__('msg.my_account')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('msg.notifications')}}</li>
        </ol>   
    </nav>
    <div class="container mt-5">
        @if(isset($data['list']) && isset($data['list']['data']) && count($data['list']['data']))
            @foreach($data['list']['data'] as $w)
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow p-4 mb-4">
                            @if(trim($w->image) != "")
                                <img class="notification-img card-img text-center pl-2 pr-2" src="{{ $w->image }}" alt="{{ $w->name }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $w->name }}</h5>
                                <p class="card-text">{{ $w->subtitle }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="row">
            <div class="col">
                @if(isset($data['last']) && $data['last'] != "")
                    <a href="{{ $data['last'] }}" class="btn btn-primary pull-left text-white"><em class="fa fa-arrow-left"></em> {{__('msg.previous')}}</a>
                @endif
            </div>
            <div class="col">
                @if(isset($data['next']) && $data['next'] != "")
                    <a href="{{ $data['next'] }}" class="btn btn-primary pull-right text-white"> {{__('msg.next')}}<em class="fa fa-arrow-right"></em></a>
                @endif
            </div>
        </div>
    </div>
</section>