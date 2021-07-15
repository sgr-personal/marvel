<section class="padding-bottom footerfix section-content">
    <a href="#" id="scroll"><span></span></a>
    <div class="container mt-5">
        @if(isset($data['list']) && isset($data['list']['data']) && count($data['list']['data']))
            @foreach($data['list']['data'] as $w)
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="row mt-2 mb-0">
                                <div class="ml-3 form-group col idtransaction"><span class="font-weight-bold">{{__('msg.id')}} #{{ $w->id }}</span></div>
                            </div>
                            <hr class="m-0">
                            <div class="m-2 ml-3">
                                <div class="row  mb-0">
                                    <div class="form-group col transamount">
                                    <span class="font-weight-bold ">{{__('msg.via')}} {{ strtoupper($w->type) }}</span></div>
                                    <div class="mr-5 form-group">
                                        <div class="wallet-header">
                                            <button class="btn btn-sm btn-{{ ($w->status == 'canceled') ? 'danger' : 'success'}}">{{ strtoupper($w->status) }}</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="form-group col m-0">
                                        <span class="text-muted mt-0">
                                            {{__('msg.date_and_time')}}
                                        </span>
                                    </div>
                                    <div class="mr-5 form-group transamount"><span class="font-weight-bold">{{__('msg.amount')}} : {{ get_price($w->amount, false) }}</span></div>
                                </div>

                                <p class="card-title product-name">{{ date('d-M-Y H:i A', strtotime($w->date_created)) }}</p>
                                <span class="text-muted mb-0">{{__('msg.message')}}</span>
                                <p class="text-dark mb-0">
                                    <span class="product-name">{{ $w->message }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="row text-center">
                <div class="col-12">
                    <br><br>
                    <h3>{{__('msg.no_transaction_history_found')}}</h3>
                </div>
                <div class="col-12">
                    <br><br>
                    <a href="{{ route('shop') }}" class="btn btn-primary"><em class="fa fa-chevron-left mr-1"></em>{{__('msg.continue_shopping')}}</a>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col">
                @if(isset($data['last']) && $data['last'] != "")
                    <a href="{{ $data['last'] }}" class="btn btn-primary pull-left text-white"><em class="fa fa-arrow-left"></em>{{__('msg.previous')}}</a>
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