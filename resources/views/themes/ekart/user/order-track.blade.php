<section class="section-content padding-bottom">
    <a href="#" id="scroll"><span></span></a>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-2">
                    <div class="row mt-2 mb-0">
                        <div class="ml-2 form-group col">
                            <span class="text-dark product-name">{{__('msg.ordered_id')}} : {{ $data['list']->id }}</span><br>

                            <span class="text-dark product-name">{{__('msg.order_date')}} :</span>
                        </div>
                    </div>
                    <hr class="mt-0">
                    @if(isset($data['list']->items) && is_array($data['list']->items) && count($data['list']->items))
                        @foreach($data['list']->items as $itm)
                            @php
                            $allStatus = ['received' => 0, 'processed' => 1, 'shipped' => 2, 'delivered' => 3];
                            $orderPlaced = "";
                            $orderProcessed = "";
                            $orderShipped = "";
                            $orderDelivered = "";
                            $orderCancelled = "";
                            $orderReturned = "";
                            foreach($itm->status as $s){
                                if($s[0] == "received"){
                                    $orderPlaced = $s[1];
                                }elseif($s[0] == "processed"){
                                    $orderProcessed = $s[1];
                                }elseif($s[0] == "shipped"){
                                    $orderShipped = $s[1];
                                }elseif($s[0] == "delivered"){
                                    $orderDelivered = $s[1];
                                }elseif($s[0] == "cancelled"){
                                    $orderCancelled = $s[1];
                                }elseif($s[0] == "returned"){
                                    $orderReturned = $s[1];
                                }
                            }
                            @endphp
                            
                            <div class="row no-gutters mb-3 order-track-content">
                            
                                <img class="ml-2 fav-image" src="{{ $itm->image }}" alt="{{ $itm->name ?? '' }}">


                                <div class="card-body">
                                    <a href="#" class="card-title text-dark">{{ strtoupper($itm->name) }} <small>{{ strtoupper(($itm->measurement ?? '') ." ". ($itm->unit ?? ''))}}</small></a>
                                    <p class="small text-muted mb-0">{{__('msg.qty')}} : {{ $itm->quantity }}</p>
                                    <p class="card-text mb-0">
                                        <span class="font-weight-bold text-dark">{{ get_price($itm->sub_total) }}</span>
                                    </p>
                                    <small class="text-primary font-weight-bold">
                                       {{__('msg.via')}} {{ strtoupper($data['list']->payment_method ?? '') }}
                                    </small>
                                    <div class="row">
                                        <p>
                                            <span class="form-group ml-3 font-weight-bold text-success">{{ strtoupper($itm->active_status) }}</span>
                                        </p>
                                        @if($orderCancelled == "")
                                            @if(intval($itm->cancelable_status) && intval($allStatus[$itm->active_status] ?? 0) <= intval($allStatus[$itm->till_status ?? 0]))
                                                <span class="form-group col add-to-fav1 orderalign">
                                                    <a role="button" href="{{ route('order-item-status', ['orderId' => $data['list']->id, 'orderItemId' => $itm->id, 'status' => 'cancelled'] ) }}" data-confirm="Are you sure, you want to cancel this item?">
                                                        <button class="btn btn-sm btn-primary">
                                                            {{__('msg.cancel_item')}}
                                                        </button>
                                                    </a>
                                                </span>
                                            @endif
                                            @if($orderDelivered != "" && intval($itm->return_status))
                                                <span class="form-group col add-to-fav1 orderalign">
                                                    <a role="button" href="{{ route('order-item-status', ['orderId' => $data['list']->id, 'orderItemId' => $itm->id, 'status' => 'returned'] ) }}" data-confirm="Are you sure, you want to return this item?">
                                                        <button class="btn btn-sm btn-primary">
                                                            {{__('msg.return_item')}}
                                                        </button>
                                                    </a>
                                                </span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                              
                            </div>
                            @if(count($itm->status))
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row bs-wizard">
                                            @if($orderPlaced != "")
                                                <div class="col-3 col-md-3 bs-wizard-step complete">
                                                    <div class="text-center bs-wizard-stepnum text-muted">{{__('msg.order_placed')}}</div>
                                                    <div class="progress"><div class="progress-bar"></div></div>
                                                    <a href="#" class="bs-wizard-dot activeStep"></a>
                                                    <div class="bs-wizard-info text-center text-muted">{{ date("d-m-Y", strtotime($orderPlaced)) }}</div>
                                                    <div class="bs-wizard-info text-center text-muted">{{ date('h:i:s A', strtotime($orderPlaced)) }}</div>
                                                </div>
                                            @endif

                                            @if($orderProcessed != "")
                                                <div class="col-3 col-md-3 bs-wizard-step complete">
                                                    <div class="text-center bs-wizard-stepnum text-muted">{{__('msg.order_processed')}}</div>
                                                    <div class="progress"><div class="progress-bar"></div></div>
                                                    <a href="#" class="bs-wizard-dot activeStep"></a>
                                                    <div class="bs-wizard-info text-center text-muted">{{ date("d-m-Y", strtotime($orderProcessed)) }}</div>
                                                    <div class="bs-wizard-info text-center text-muted">{{ date("h:i:s A", strtotime($orderProcessed)) }}</div>
                                                </div>
                                            @elseif($orderCancelled == "")
                                                <div class="col-3 col-md-3 bs-wizard-step disabled">
                                                    <div class="text-center bs-wizard-stepnum text-muted">{{__('msg.order_processed')}}</div>
                                                    <div class="progress"><div class="progress-bar"></div></div>
                                                    <a href="#" class="bs-wizard-dot"></a>
                                                </div>
                                            @endif

                                            @if($orderShipped != "")
                                                <div class="col-3 col-md-3 bs-wizard-step complete">
                                                    <div class="text-center bs-wizard-stepnum text-muted">{{__('msg.order_shipped')}}</div>
                                                    <div class="progress"><div class="progress-bar"></div></div>
                                                    <a href="#" class="bs-wizard-dot activeStep"></a>
                                                    <div class="bs-wizard-info text-center text-muted">{{ date("d-m-Y", strtotime($orderShipped)) }}</div>
                                                    <div class="bs-wizard-info text-center text-muted">{{ date("h:i:s A", strtotime($orderShipped)) }}</div>
                                                </div>
                                            @elseif($orderCancelled == "")
                                                <div class="col-3 col-md-3 bs-wizard-step disabled">
                                                    <div class="text-center bs-wizard-stepnum text-muted">{{__('msg.order_shipped')}}</div>
                                                    <div class="progress"><div class="progress-bar"></div></div>
                                                    <a href="#" class="bs-wizard-dot"></a>
                                                </div>
                                            @endif

                                            @if($orderDelivered != "")
                                                <div class="col-3 col-md-3 bs-wizard-step complete">
                                                    <div class="text-center bs-wizard-stepnum text-muted">{{__('msg.order_delivered')}}</div>
                                                    <div class="progress"><div class="progress-bar"></div></div>
                                                    <a href="#" class="bs-wizard-dot activeStep"></a>
                                                    <div class="bs-wizard-info text-center text-muted">{{ date("d-m-Y", strtotime($orderDelivered)) }}</div>
                                                    <div class="bs-wizard-info text-center text-muted">{{ date("h:i:s A", strtotime($orderDelivered)) }}</div>
                                                </div>
                                            @elseif($orderCancelled == "")
                                                <div class="col-3 col-md-3 bs-wizard-step disabled">
                                                    <div class="text-center bs-wizard-stepnum text-muted">{{__('msg.order_delivered')}}</div>
                                                    <div class="progress"><div class="progress-bar"></div></div>
                                                    <a href="#" class="bs-wizard-dot"></a>
                                                </div>
                                            @endif

                                            @if($orderCancelled != "")
                                                <div class="col-3 col-md-3 bs-wizard-step complete">
                                                    <div class="text-center bs-wizard-stepnum text-muted">{{__('msg.order_cancelled')}}</div>
                                                    <div class="progress"><div class="progress-bar"></div></div>
                                                    <a href="#" class="bs-wizard-dot activeStep"></a>
                                                    <div class="bs-wizard-info text-center text-muted">{{ date("d-m-Y", strtotime($orderCancelled)) }}</div>
                                                    <div class="bs-wizard-info text-center text-muted">{{ date("h:i:s A", strtotime($orderCancelled)) }}</div>
                                                </div>
                                            @endif

                                            @if($itm->applied_for_return == true)
                                                @if($orderReturned != "")
                                                    <div class="col-3 col-md-3 bs-wizard-step complete">
                                                        <div class="text-center bs-wizard-stepnum text-muted">{{__('msg.order_returned')}}/div>
                                                        <div class="progress"><div class="progress-bar"></div></div>
                                                        <a href="#" class="bs-wizard-dot activeStep"></a>
                                                        <div class="bs-wizard-info text-center text-muted">{{ date("d-m-Y", strtotime($orderReturned)) }}</div>
                                                        <div class="bs-wizard-info text-center text-muted">{{ date("h:i:s A", strtotime($orderReturned)) }}</div>
                                                    </div>
                                                @else
                                                    <div class="col-3 col-md-3 bs-wizard-step disabled">
                                                        <div class="text-center bs-wizard-stepnum text-muted">{{__('msg.order_returned')}}</div>
                                                        <div class="progress"><div class="progress-bar"></div></div>
                                                        <a href="#" class="bs-wizard-dot"></a>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="row no-gutters mt-1">
            <div class="col-md-12">
                <div class="card shadow mb-2">
                    <span class="m-2 font-weight-bold text-dark">{{__('msg.price_detail')}}</span>

                    <div class="row mr-5">
                        <div class="ml-2 form-group col">
                            <span class="text-dark product-name">{{__('msg.items_amount')}} : </span>
                        </div>
                        <div class="form-group">
                           <span class="price2">{{ get_price($data['list']->total, false)}}</span>
                        </div>
                    </div>

                    <div class="row mr-5">
                        <div class="ml-2 form-group col">
                            <span class="text-dark product-name">{{__('msg.delivery_charge')}} : </span>
                        </div>
                        <div class="form-group">
                           <span class="price2">+ {{ get_price($data['list']->delivery_charge, false)}}</span>
                        </div>
                    </div>

                    <div class="row mr-5">
                        <div class="ml-2 form-group col">
                            <span class="text-dark product-name">{{__('msg.tax')}}({{ $data['list']->tax_percentage}}%) : </span>
                        </div>
                        <div class="form-group">
                           <span class="price2">+ {{ get_price($data['list']->tax_amount, false) }}</span>
                        </div>
                    </div>

                    <div class="row mr-5">
                        <div class="ml-2 form-group col">
                            <span class="text-dark product-name">{{__('msg.discount')}}(0%) : </span>
                        </div>
                        <div class="form-group">
                           <span class="price2">- {{ get_price($data['list']->discount, false)}}</span>
                        </div>
                    </div>

                    <div class="row mr-5">
                        <div class="ml-2 form-group col">
                            <span class="text-dark product-name">{{__('msg.total')}} : </span>
                        </div>
                        <div class="form-group">
                           <span class="price">{{ get_price(floatval($data['list']->total) + floatval($data['list']->delivery_charge) + floatval($data['list']->tax_amount) - floatval($data['list']->discount), false)}}</span>
                        </div>
                    </div>

                    <div class="row mr-5">
                        <div class="ml-2 form-group col">
                            <span class="text-dark product-name">{{__('msg.promo_code_discount')}} : </span>
                        </div>
                        <div class="form-group">
                           <span class="price2">- {{ get_price($data['list']->promo_discount, false) }}</span>
                        </div>
                    </div>

                    <div class="row mr-5">
                        <div class="ml-2 form-group col">
                            <span class="text-dark product-name">{{__('msg.wallet_balance')}}  : </span>
                        </div>
                        <div class="form-group">
                           <span class="price2">-{{ get_price($data['list']->wallet_balance, false) }}</span>
                        </div>
                    </div>

                    <div class="row mr-5">
                        <div class="ml-2 form-group col">
                            <span class="text-dark font-weight-bold">{{__('msg.final_total')}} : </span>
                        </div>
                        <div class="form-group">
                           <span class="text-primary font-weight-bold">{{ get_price($data['list']->final_total, false) }}</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row no-gutters mt-1">
            <div class="col-md-12">
                <div class="card shadow mb-2">
                    <span class="m-2 font-weight-bold text-dark">{{__('msg.other_details')}}</span>
                    <div class="ml-4">
                        <div class="row">
                            <div class="form-group">
                                <span class="text-dark product-name">{{__('msg.name')}} : {{ $data['list']->user_name }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <span class="text-dark product-name">{{__('msg.mobile_no')}}: {{ $data['list']->mobile }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <span class="text-dark product-name">{{__('msg.address')}} : {{ $data['list']->address ?? '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row no-gutters mt-1">
            <div class="col-md-12">
                <div class="card shadow mb-2">
                    <span class="m-2 font-weight-bold text-dark">{{__('msg.order_status')}}</span>
                    <div class="card-body">
                        @if(count($data['list']->status))
                            @php
                            $orderPlaced = "";
                            $orderProcessed = "";
                            $orderShipped = "";
                            $orderDelivered = "";
                            $orderCancelled = "";
                            $orderReturned = "";
                            foreach($data['list']->status as $s){
                                if($s[0] == "received"){
                                    $orderPlaced = $s[1];
                                }elseif($s[0] == "processed"){
                                    $orderProcessed = $s[1];
                                }elseif($s[0] == "shipped"){
                                    $orderShipped = $s[1];
                                }elseif($s[0] == "delivered"){
                                    $orderDelivered = $s[1];
                                }elseif($s[0] == "cancelled"){
                                    $orderCancelled = $s[1];
                                }elseif($s[0] == "returned"){
                                    $orderReturned = $s[1];
                                }
                            }
                            @endphp
                            <div class="row bs-wizard">
                                @if($orderPlaced != "")
                                    <div class="col-3 col-md-3 bs-wizard-step complete">
                                        <div class="text-center bs-wizard-stepnum text-muted">{{__('msg.order_placed')}}</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="#" class="bs-wizard-dot activeStep"></a>
                                        <div class="bs-wizard-info text-center text-muted">{{ date("d-m-Y", strtotime($orderPlaced)) }}</div>
                                        <div class="bs-wizard-info text-center text-muted">{{ date('h:i:s A', strtotime($orderPlaced)) }}</div>
                                    </div>
                                @endif

                                @if($orderProcessed != "")
                                    <div class="col-3 col-md-3 bs-wizard-step complete">
                                        <div class="text-center bs-wizard-stepnum text-muted">{{__('msg.order_processed')}}</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="#" class="bs-wizard-dot activeStep"></a>
                                        <div class="bs-wizard-info text-center text-muted">{{ date("d-m-Y", strtotime($orderProcessed)) }}</div>
                                        <div class="bs-wizard-info text-center text-muted">{{ date("h:i:s A", strtotime($orderProcessed)) }}</div>
                                    </div>
                                @elseif($orderCancelled == "")
                                    <div class="col-3 col-md-3 bs-wizard-step disabled">
                                        <div class="text-center bs-wizard-stepnum text-muted">{{__('msg.order_processed')}}</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="#" class="bs-wizard-dot"></a>
                                    </div>
                                @endif

                                @if($orderShipped != "")
                                    <div class="col-3 col-md-3 bs-wizard-step complete">
                                        <div class="text-center bs-wizard-stepnum text-muted">{{__('msg.order_shipped')}}</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="#" class="bs-wizard-dot activeStep"></a>
                                        <div class="bs-wizard-info text-center text-muted">{{ date("d-m-Y", strtotime($orderShipped)) }}</div>
                                        <div class="bs-wizard-info text-center text-muted">{{ date("h:i:s A", strtotime($orderShipped)) }}</div>
                                    </div>
                                @elseif($orderCancelled == "")
                                    <div class="col-3 col-md-3 bs-wizard-step disabled">
                                        <div class="text-center bs-wizard-stepnum text-muted">{{__('msg.order_shipped')}}</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="#" class="bs-wizard-dot"></a>
                                    </div>
                                @endif

                                @if($orderDelivered != "")
                                    <div class="col-3 col-md-3 bs-wizard-step complete">
                                        <div class="text-center bs-wizard-stepnum text-muted">{{__('msg.order_delivered')}}</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="#" class="bs-wizard-dot activeStep"></a>
                                        <div class="bs-wizard-info text-center text-muted">{{ date("d-m-Y", strtotime($orderDelivered)) }}</div>
                                        <div class="bs-wizard-info text-center text-muted">{{ date("h:i:s A", strtotime($orderDelivered)) }}</div>
                                    </div>
                                @elseif($orderCancelled == "")
                                    <div class="col-3 col-md-3 bs-wizard-step disabled">
                                        <div class="text-center bs-wizard-stepnum text-muted">{{__('msg.order_delivered')}}</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="#" class="bs-wizard-dot"></a>
                                    </div>
                                @endif

                                @if($orderCancelled != "")
                                    <div class="col-3 col-md-3 bs-wizard-step complete">
                                        <div class="text-center bs-wizard-stepnum text-muted">{{__('msg.order_cancelled')}}</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="#" class="bs-wizard-dot activeStep"></a>
                                        <div class="bs-wizard-info text-center text-muted">{{ date("d-m-Y", strtotime($orderCancelled)) }}</div>
                                        <div class="bs-wizard-info text-center text-muted">{{ date("h:i:s A", strtotime($orderCancelled)) }}</div>
                                    </div>
                                @endif

                                @if($orderReturned != "")
                                    <div class="col-3 col-md-3 bs-wizard-step complete">
                                        <div class="text-center bs-wizard-stepnum text-muted">{{__('msg.order_returned')}}</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="#" class="bs-wizard-dot activeStep"></a>
                                        <div class="bs-wizard-info text-center text-muted">{{ date("d-m-Y", strtotime($orderReturned)) }}</div>
                                        <div class="bs-wizard-info text-center text-muted">{{ date("h:i:s A", strtotime($orderReturned)) }}</div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!--- cancel confirm box -->
        <div class="modal" id="modal">
            <div class="modal-dialog mt-2">
                <div class="modal-content">
                    <div class="modal-body">
                        <span class="text-dark text-center">{{__('msg.are_you_sure')}}</span>
                        <div class="row add-to-fav1 mr-1">
                            <a href="" id="modal-btn-yes" class="btn text-primary font-weight-bold">{{__('msg.yes')}}</a>
                            <button type="button" class="btn font-weight-bold text-primary" data-dismiss="modal">{{__('msg.no')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--- cancel confirm box -->
    </div>
</section>
