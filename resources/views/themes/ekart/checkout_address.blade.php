<section class="section-content padding-bottom mt-5 footerfix">
    <a href="#" id="scroll"><span></span></a>
    <div class="container">
        <div class="card shadow-sm mb-4">
            <div class="row">
                <div class="col-md-4 col-4 text-center">
                    <a href="{{ route('checkout') }}"><span class="icon dark"><em class="fa fa-chevron-circle-right  delivery-icon"></em> {{__('msg.delivery')}}</span></a>
                </div>
                <div class="col-md-4 col-4 text-center">
                    <span class="icon dark"><em class="fa fa-chevron-circle-right delivery-icon"></em> {{__('msg.address')}}</span>
                </div>
                <div class="col-md-4 col-4 text-center payment-icon">
                    <span class="icon dark"><em class="fa fa-chevron-circle-right"></em> {{__('msg.payment')}}</span>
                </div>
            </div>
        </div>
        <main>
            @if(isset($data['address']) && is_array($data['address']) && count($data['address']))
            <div class="row">
                <div class="col-md-12" id="address">
                    <div class="card shadow mb-4">
                        <p class="product-name pb-0 font-weight-bold head title-sec" id="mydesc">{{__('msg.delivery_address')}}</p>
                        <hr class="mb-0">
                        <table class="table table-borderless table-shopping-cart" aria-describedby="mydesc" aria-hidden="true">
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="{{ route('checkout-address') }}" method="POST">
                                                @foreach($data['address'] as $a)
                                                    @if(isset($a->id) && intval($a->id))
                                                        <div class="row delivery-address">
                                                            <span class="form-group edit-delete">
                                                                <button class="btn editAddress" data-data='{{ json_encode($a) }}'> <em class="fa fa-pencil-alt"></em></button>
                                                                <a href="{{ route('address-remove', $a->id) }}" class="btn"> <em class="fas fa-times text-danger"></em></a>
                                                            </span>
                                                            <span class="form-group ml-2">
                                                                <input type="radio" name="id" value="{{ $a->id }}" {{ (count($data['address']) == 1 || (isset($a->is_default) && intval($a->is_default)) ? 'checked=checked' : '') }}>
                                                                <label>
                                                                    <strong>{{ $a->name ?? '' }}</strong><br>
                                                                    <label class="badge badge-primary">{{ $a->type }}</label>
                                                                    @if(isset($a->is_default) && intval($a->is_default))
                                                                        <label class="badge badge-primary">{{__('msg.default')}}</label>
                                                                    @endif
                                                                    {{ $a->address ?? '' }}, {{ $a->area_name ?? '' }}<br>
                                                                    {{ $a->city_name ?? ''}} - {{ $a->pincode ?? '' }}<br>
                                                                    {{__('msg.mobile')}}: {{ ($a->country_code ?? '') ." ". ($a->mobile ?? '-') }}
                                                                </label>
                                                            </span>
                                                        </div>
                                                        <hr class="p-0">
                                                    @endif
                                                @endforeach
                                                <div class="form-group mb-0 float-right">
                                                    <span onclick="address()" class="btn btn-primary text-uppercase">{{__('msg.add_new_address')}}</span>
                                                    @if(isset($data['address'][0]))
                                                        <button type="submit" class="btn btn-primary text-uppercase add-to-cart">{{__('msg.confirm')}} <em class="fa fa-check"></em></button>
                                                    @endif
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-12" id="editAddress">
                    <div class="card">
                        <p class="product-name pb-0 font-weight-bold head title-sec">{{__('msg.edit_address')}}</p>
                        <hr class="mb-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg">
                                    <form action='{{ route('address-add') }}' id='formEditAddress' method="POST">
                                        <input type="hidden" name="id">
                                        <input type="hidden" name="latitude" value="0">
                                        <input type="hidden" name="longitude" value="0">
                                        <input type="hidden" name="country_code" value="0">
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label>{{__('msg.name')}}</label>
                                                <input class="form-control" name="name" type="text">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label>{{__('msg.mobile_no')}}</label>
                                                <input class="form-control" id='editPhone' type="number" name="mobile">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label>{{__('msg.alternate_mobile_no')}}</label>
                                                <input class="form-control" type="number" name="alternate_mobile">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label>{{__('msg.address')}}</label>
                                                <input class="form-control" type="text" name="address">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label>{{__('msg.landmark')}}</label>
                                                <input class="form-control" type="text" name="landmark">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label>{{__('msg.pincode')}}</label>
                                                <input class="form-control" type="number" name="pincode">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label>{{__('msg.select_city')}}</label>
                                                <br>
                                                <select name='city' class="form-control" required>
                                                </select>
                                            </div>
                                            <div class="form-group col">
                                                <label>{{__('msg.select_area')}}</label>
                                                <br>
                                                <select name='area' class="form-control" required>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label>{{__('msg.state')}}</label>
                                                <input class="form-control" type="text" name="state" required>
                                            </div>
                                            <div class="form-group col">
                                                <label>{{__('msg.country')}}</label>
                                                <input class="form-control" type="text" name="country" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <label class="radio-inline">
                                              <input class="mr-2" type="radio" name="type" checked value="Home">{{__('msg.home')}}
                                            </label>
                                            <label class="radio-inline  ml-5">
                                              <input class="mr-2" type="radio" name="type" value="Work">{{__('msg.work')}}
                                            </label>
                                            <label class="radio-inline  ml-5">
                                              <input class="mr-2" type="radio" name="type" value="Other">{{__('msg.other')}}
                                            </label>
                                        </div>
                                        <div class="form-row mb-4 mt-3">
                                            <input type="checkbox" name="is_default" class=" mt-1" />
                                            <label class="control-label" for="default-address"> {{__('msg.set_as_default_address')}}</label>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block text-uppercase"> {{__('msg.update')}} </button>
                                            <button class="btn btn-primary btn-block text-uppercase AddEditAddressCancel"> {{__('msg.cancel')}} </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="row padding-bottom {{ count($data['address']) > 0 ? 'hidden' : 'visible' }}">
                <div class="col-md-12" id="addAddress">
                    <div class="card">
                        <p class="product-name pb-0 font-weight-bold head title-sec">{{__('msg.add_new_address')}}</p>
                        <hr class="mb-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg">
                                    <form action='{{ route('address-add') }}' id='formAddAddress' method='POST'>
                                        <input type="hidden" name="latitude" value="0">
                                        <input type="hidden" name="longitude" value="0">
                                        <input type="hidden" name="country_code" value="0">
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label>{{__('msg.name')}}</label>
                                                <input class="form-control" name="name" type="text" placeholder="Name" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label>{{__('msg.mobile_no')}}</label>
                                                <input class="form-control" id='addPhone' type="number" placeholder="Mobile No" name="mobile" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label>{{__('msg.alternate_mobile_no')}}</label>
                                                <input class="form-control" type="number" placeholder="Altername Mobile No" name="alternate_mobile">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label>{{__('msg.address')}}</label>
                                                <input class="form-control" type="text" placeholder="Address" name="address" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label>{{__('msg.landmark')}}</label>
                                                <input class="form-control" type="text" placeholder="Landmark" name="landmark" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label>{{__('msg.pincode')}}</label>
                                                <input class="form-control" type="number" placeholder="Pincode" name="pincode" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label>{{__('msg.select_city')}}</label>
                                                <br>
                                                <select name='city' class="form-control" required>
                                                </select>
                                            </div>
                                            <div class="form-group col">
                                                <label>{{__('msg.select_area')}}</label>
                                                <br>
                                                <select name='area' class="form-control" required>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label>{{__('msg.state')}}</label>
                                                <input class="form-control" type="text" name="state" required placeholder="State">
                                            </div>
                                            <div class="form-group col">
                                                <label>{{__('msg.country')}}</label>
                                                <input class="form-control" type="text" name="country" required placeholder="Country">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <label class="radio-inline">
                                                <input class="mr-2" type="radio" name="type" value="Home" checked>{{__('msg.home')}}
                                            </label>
                                            <label class="radio-inline  ml-5">
                                                <input class="mr-2" type="radio" name="type" value="Work">{{__('msg.work')}}
                                            </label>
                                            <label class="radio-inline  ml-5">
                                                <input class="mr-2" type="radio" name="type" value="Other">{{__('msg.other')}}
                                            </label>
                                        </div>
                                        <div class="form-row mb-4 mt-3">
                                            <input type="checkbox" name="is_default" class=" mt-1" />
                                            <label class="control-label" for="default-address"> {{__('msg.set_as_default_address')}}</label>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block text-uppercase"> {{__('msg.add_new_address')}} </button>
                                            <button class="btn btn-primary btn-block text-uppercase AddEditAddressCancel"> {{__('msg.cancel')}} </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</section>
<script src="{{ asset('js/address.js') }}"></script>