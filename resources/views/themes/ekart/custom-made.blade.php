<section class="section-content footerfix padding-bottom">
    <div class="container">
        <div class="row justify-content-md-center mt-5 mb-5">
            <div class="col-md-8">
                <div class="" id="cardRegister">
                    <div class="card mx-auto">
                        <div class="card-body">
                            <h4 class="card-title mb-4">{{__('msg.custom_made_computers')}} </h4>
                            <p>You are 30 seconds away from earning your own money!</p>
                            {{--<form method="post" action="/quotation-pdf">
                                {{csrf_field()}}
                                <input type="hidden" name="id" value="1">
                                <button type="button" class="btn btn-primary btn-block" style="width: 25%;margin-left: 15px;"> {{__('msg.download_pdf')}} </button>
                            </form>--}}

                            <input type="hidden" name="query_id" id="query_id" value="1">
                            <a href="{{ URL::to('/quotation/3') }}" id="export_pdf_id">Export PDF</a>
                            {{--<button type="button" class="btn btn-primary btn-block" onclick="downloadPdf();" style="width: 25%;margin-left: 15px;"> {{__('msg.download_pdf')}} </button>--}}

                            <h3 id="total_price_view"></h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        @foreach ($data['product_list']['left'] as $products)
                                            <div class="form-group">
                                                <label>{{$products->name}}</label>
                                                <select class="form-control products">
                                                    <option value="0" data-price="0"> None </option>
                                                    @foreach ($products->variants as $variants)
                                                        <option value="{{$variants->id."@@".$variants->price}}">
                                                            {{$products->name." [".$variants->measurement." ".$variants->unit_name."] of ksh ".$variants->price}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-6">
                                    @foreach ($data['product_list']['right'] as $products)
                                        <div class="form-group">
                                            <label>{{$products->name}}</label>
                                            <select class="form-control products">
                                                <option value="0" data-price="0"> None </option>
                                                @foreach ($products->variants as $variants)
                                                    <option value="{{$variants->id."@@".$variants->price}}">
                                                        {{$products->name." [".$variants->measurement." ".$variants->unit_name."] of ksh ".$variants->price}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endforeach
                                </div>
                                    <button type="button" class="btn btn-primary btn-block" onclick="showQueryModal();" style="width: 25%;margin-left: 15px;"> {{__('msg.calculate_total')}} </button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="query-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="exampleModalLabel">Submit Query</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="">
                    <input type="hidden" id="product_ids" value="">
                    <input type="hidden" id="total_price" value="0">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Full Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="number" class="form-control" id="phone" placeholder="Enter Phone Number">
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                        <button type="button" class="btn btn-success" onclick="submitQuery();">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->

</section>
<script src="{{ asset('js/login.js') }}"></script>
<script type="text/javascript">
    function showQueryModal() {
        var productIds = "";
        var totalPrice = 0;
        $('.products').each(function (k, obj) {
            var value = $(obj).val();
            if (value != 0) {
                var valAry = value.split("@@");
                productIds = productIds.trim() != "" ? valAry[0]+","+productIds : valAry[0];
                totalPrice = parseInt(totalPrice) + parseInt(valAry[1]);
            }
        });
        if (totalPrice != 0 && productIds != "") {
            jQuery('#query-modal').modal('show', {backdrop: 'static'});
            $("#product_ids").val(productIds);
            $("#total_price").val(totalPrice);
        } else {
            alert("Please select atleast one product");
        }
    }

    function submitQuery() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var total_price = $("#total_price").val();
        var product_ids = $("#product_ids").val();
        if ($("#name").val() == "") {
            alert("Please enter Name")
            $("#name").focus();
            return false;
        }
        if ($("#email").val() == "") {
            alert("Please enter Mail")
            $("#email").focus();
            return false;
        }
        if ($("#phone").val() == "") {
            alert("Please enter Phone")
            $("#phone").focus();
            return false;
        }
        var name = $("#name").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: 'custom-made-query', // the url where we want to POST
            data: {product_ids: product_ids, name: name, email: email, phone: phone}, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true,
            success: function (response) {
                console.log(response);
                jQuery('#query-modal').modal('hide');
                document.getElementById("total_price_view").innerHTML = "Total ksh "+total_price;
            }
        });
    }

    function downloadPdf() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var query_id = $("#query_id").val();
        if (query_id > 0) {
            $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: 'quotation-pdf', // the url where we want to POST
                data: {query_id: query_id}, // our data object
                dataType: 'json', // what type of data do we expect back from the server
                encode: true,
                success: function (response) {
                    console.log(response);
                    return false;
                    jQuery('#query-modal').modal('hide');
                    document.getElementById("total_price_view").innerHTML = "Total ksh "+total_price;
                }
            });
        } else {
            alert("Something went wrong!")
        }
    }
</script>
