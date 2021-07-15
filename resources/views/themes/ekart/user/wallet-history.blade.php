<section class="padding-bottom footerfix section-content">
    <a href="#" id="scroll"><span></span></a>
    <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                        <div class="col-md-4">&nbsp;</div>
                        <div class="col-md-4">
                            <p>Your Balance : Rs.500</p>
                            <a role="button" data-confirm="Confirm Order Amount">
                            <button id='proceed' class="btn btn-success add-to-cart">
                                 {{__('msg.recharge_your_wallet')}} <em class="fa fa-arrow-right"></em>
                            </button>
                            </a>
                        </div>
                        <div class="col-md-4">&nbsp;</div>
                        </div>
                    </div>
                </div>

                 <!-- The Modal -->
            <div id="orderConfirm" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{__('msg.recharge_your_wallet')}}
                            <div class=" mb-0 mr-4 row">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="">
                                <tr class="mr-5">
                                    <td>                               
                                    <form method="POST">
                                        <div class="form-row">
                                            <div class="col form-group">
                                                <label>Amount</label>
                                                <input type="number" name="wallet_amount" class="form-control" required>
                                            </div>
                                        </div>                                      
                                    
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label>Message</label>
                                            <textarea class="form-control"> </textarea>
                                        </div>
                                    </div>
                                    <h5 class="card-title title-sec ml-3 mt-3" id="myDec2">{{__('msg.payment_method')}}</h5>
                           
                                    <div class="form-group">
                                                <div class="alert alert-danger" id="paymentError">{{__('msg.select_payment_method')}}</div>
                                            </div>
                                            <div class="form-group">
                                                @if(isset(Cache::get('payment_methods')->paypal_payment_method) && Cache::get('payment_methods')->paypal_payment_method == 1)
                                                    <label class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" value="paypal" name='payment_method'>
                                                        <span class="custom-control-label"> {{__('msg.paypal')}}</span>
                                                    </label>
                                                @endif
                                                @if(isset(Cache::get('payment_methods')->payumoney_payment_method) && Cache::get('payment_methods')->payumoney_payment_method == 1)
                                                    <label class="custom-control custom-radio" id="PayUMoney">
                                                        <input class="custom-control-input" type="radio" value="payumoney" name='payment_method'>
                                                        <span class="custom-control-label"> {{__('msg.PayUMoney')}}</span>
                                                    </label>
                                                    <label class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" value="payumoney-bolt" name='payment_method'>
                                                        <span class="custom-control-label"> {{__('msg.PayUMoney')}}</span>
                                                    </label>
                                                @endif
                                                @if(isset(Cache::get('payment_methods')->razorpay_payment_method) && Cache::get('payment_methods')->razorpay_payment_method == 1)
                                                    <label class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" value="razorpay" name='payment_method'>
                                                        <span class="custom-control-label"> {{__('msg.Razorpay')}}</span>
                                                    </label>
                                                @endif
                                                @if(isset(Cache::get('payment_methods')->stripe_payment_method) && Cache::get('payment_methods')->stripe_payment_method == 1)
                                                    <label class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" value="stripe" name='payment_method'>
                                                        <span class="custom-control-label"> {{__('msg.Stripe')}}</span>
                                                    </label>
                                                @endif
                                                @if(isset(Cache::get('payment_methods')->midtrans_payment_method) && Cache::get('payment_methods')->midtrans_payment_method == 1)
                                                    <label class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" value="midtrans" name='payment_method'>
                                                        <span class="custom-control-label"> {{__('msg.Midtrans')}}</span>
                                                    </label>
                                                @endif
                                                @if(isset(Cache::get('payment_methods')->flutterwave_payment_method) && Cache::get('payment_methods')->flutterwave_payment_method == 1)
                                                    <label class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" value="flutterwave" name='payment_method'>
                                                        <span class="custom-control-label"> {{__('msg.flutterwave')}}</span>
                                                    </label>
                                                @endif
                                                @if(isset(Cache::get('payment_methods')->paystack_payment_method) && Cache::get('payment_methods')->paystack_payment_method == 1)
                                                    <label class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" value="paystack" name='payment_method'>
                                                        <span class="custom-control-label"> {{__('msg.paystack')}}</span>
                                                    </label>
                                                @endif
                                                @if(isset(Cache::get('payment_methods')->paytm_payment_method) && Cache::get('payment_methods')->paytm_payment_method == 1)
                                                    <label class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" value="paytm" name='payment_method'>
                                                        <span class="custom-control-label"> {{__('msg.paytm')}}</span>
                                                    </label>
                                                @endif
                                            </div>

                                    <div class="form-group">
                                        <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block mt-4">{{__('msg.recharge')}} </button>
                                    </div>         
                                </form>                                       
                                    </td>
                                </tr>                                
                               
                            </div>
                            <div class="row add-to-fav1 mr-4">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @if(isset($data['list']) && isset($data['list']['data']) && count($data['list']['data']))
            @foreach($data['list']['data'] as $w)
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="row mt-2 mb-0">
                                <div class="ml-2 form-group walletid col"><span class="font-weight-bold">{{__('msg.id')}} #{{ $w->id }}</span></div>
                                <div class="mr-5 form-group">
                                    <div class="wallet-header">
                                        <button class="btn btn-sm btn-{{ ($w->type == 'debit') ? 'danger' : 'success' }}">{{ strtoupper($w->type) }}</button>
                                    </div>
                                </div>
                            </div>
                            <hr class="m-0">
                            <div class="m-2">
                                <a class="add-to-fav1 name">{{__('msg.amount')}} : {{ get_price($w->amount, false) }}</a>
                                <span class="text-muted mt-0">
                                    {{__('msg.date_and_time')}}
                                </span>

                                <p href="#" class="card-title product-name">{{ date('d-M-Y H:i A', strtotime($w->date_created)) }}</p>
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
                    <h3>{{__('msg.no_wallet_history_found')}}</h3>
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

<script src="{{ asset('js/checkout-payment.js') }}"></script>
