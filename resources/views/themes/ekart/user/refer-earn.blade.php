<section class="section-content footerfix padding-bottom">
    <a href="#" id="scroll"><span></span></a>
    <div class="container mt-5 ">
        <div class="row">
            @include("themes.$theme.user.sidebar")
            <div class="col-md-9">
                <div class="card shadow-sm w-100 mb-3">
                    <div class="card-body">
                        <p class="card-text ">
                            <em class="fas fa-wallet align-content-left wallet"></em>
                            <span class="text-wrap ">{{__('msg.refer_earn')}}.
                                {{__('msg.minimun_order_amount_soul')}}
                                {{__('msg.which_allows_you')}}.
                            </span>
                        </p>
                    </div>
                </div>
                <div class="card shadow-sm border-0 w-100 mb-3">
                    <div class="row text-center mb-2">
                        <div class="col gift">
                            <em class="fa fa-gift"></em>
                        </div>
                     </div>
                    <div class="row text-center mb-3">
                        <div class="col">
                            <span class="text-center">{{__('msg.refer_and_earn')}}</span>
                        </div>
                    </div>
                    <div class="row text-center mb-4">
                        <div class="col">
                            <span class="text-danger">{{__('msg.your_referral_code')}}</span>
                        </div>
                    </div>
                    <div class="row text-center mb-3">
                        <div class="col">
                            <input type="text" name="refercode" id='referCode' class="rounded border-info text-center refer-border" value="{{ $data['profile']['referral_code'] }}">
                        </div>
                    </div>
                    <div class="row text-center mt-2 mb-3">
                        <div class="col">
                            <span class="text-primary"><a href="#" onclick="copycode()">{{__('msg.tap_to_copy')}}</a></span>
                        </div>
                    </div>
                    <div class="row text-center mt-2 mb-3">
                        <div class="col">
                            <a href="{{ route('refer', $data['profile']['referral_code']) }}" target="_blank" class="btn btn-primary rounded text-capitalize refer-share"><em class="fa fa-share-alt"></em> {{__('msg.refer_now')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</section>