"use strict";

$( document ).ready(function() {
    $("body").on("submit", ".addToCart", function(){
        if($(this).find('select[name=child_id] option:selected').val() == 0){
            $(this).find('select[name=child_id]').focus().vibrate({stopAfterTime:2});
            return false;
        }else{
            return true;
        }
    });
    $("body").on("click", ".button-plus", function(){
        var qP=$(this).parent().parent().find('.qtyPicker');
        var nP = parseInt(qP.val())+1;
        if(qP.data('max') > nP){qP.val(nP);$(this).parent().parent().find('.button-minus').removeAttr('disabled')}else{$(this).attr('disabled','disabled')}
    });
    $("body").on("click", ".button-minus", function(){
        var qP=$(this).parent().parent().find('.qtyPicker');
        var nP = parseInt(qP.val())-1;
        if(qP.data('min') <= nP){qP.val(nP);$(this).parent().parent().find('.button-plus').removeAttr('disabled')}else{$(this).attr('disabled','disabled')}
    });
    if($('[data-toggle="tooltip"]').length > 0) {
        $('[data-toggle="tooltip"]').tooltip()
    }
    $("body").on("change", ".addToCart select[name=child_id]", function(){
        var val = $(this).find('option:selected').val();
        if(val > 0){
            $(".actualPrice").html($(this).find('option:selected').data('price')).show();
            $(".rangePrice").hide()
        }else{
            $(".actualPrice").hide();
            $(".rangePrice").show()
        }
    });

    $("body").on("change", "select[name=child_id]", function(){
        var selected = $(this).find('option:selected');
        $("#productPrice" + $(this).data('id')).html(selected.data('price'));
        if(selected.data('mrp') == ""){
            $("#productMrp" + $(this).data('id')).hide();
        }else{
            $("#productMrp" + $(this).data('id')).html(selected.data('mrp')).show();
        }
        $("#productTitle" + $(this).data('id')).html(selected.text());
        if(selected.data('discount') != ""){
            $("#productDiscount" + $(this).data('id')).html(selected.data('discount')).show();
        }else{
            $("#productDiscount" + $(this).data('id')).hide();
        }
    });

    $(".btnEdit").on("click", function(e){
        $(this).closest('tr').find('.cartShow').toggle();
        $(this).closest('tr').find('.cartEdit').toggle();
    });
    $(".cartSave").on("click", function(e){
        var tr = $(this).closest('tr');
        if(tr.find('form.cartEdit').find('input[name=qty]').val() == tr.find('.price-wrap.cartShow').html()){
            tr.find('.cartShow').toggle();
            tr.find('.cartEdit').toggle();
        }else{
            tr.find('form.cartEdit').submit();
        }
    });
    $("#btnRegister").on("click", function(e){
        $("#cardLogin").hide();
        $("#registerError").hide();
        $("#phone").val('');
        $("#cardRegister input[type=hidden][name=action]").val('1');
        $("#cardRegister").show();
        $("#cardRegister .card-title").html('Register');
        $(".alreadyLogin").show();
        $(".backToLogin").hide();
    });
    $(".btnLogin").on("click", function(e){
        $("#cardLogin").show();
        $("#cardRegister").hide();
    });
    $("#btnForgot").on("click", function(e){
        $("#cardLogin").hide();
        $("#registerError").hide();
        $("#phone").val('');
        $("#cardRegister input[type=hidden][name=action]").val('0');
        $("#cardRegister .card-title").html('Forgot Password');
        $("#cardRegister").show();
        $(".alreadyLogin").hide();
        $(".backToLogin").show();
    });
    <!-- search function -->
    $("#searchForm").on("submit", function(e){
        e.preventDefault();
        var s = $(this).find('input[name=s][type=text]').val().trim();
        if(s != ""){
            window.location.href = $(this).attr('action') + "/" + s;
        }
    });
    <!-- end search function -->
    
    $(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
        $(this).closest(".select2-container").siblings('select:enabled').select2('open');
    });
    
    <!-- reset password -->
    $("#formResetPassword").on("submit", function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            success: function(response){
                var data = JSON.parse(response);
                if(data.status === false){
                    $("#errorResetPassword").html(data.message).show();
                }else{
                    window.location.href = '/login';
                }
            }
        });
    });
    <!-- end reset password -->
    
    $(".ajax-form").on("submit", function(e){

        e.preventDefault();

        var formResponse = $(this).find('.formResponse');

        formResponse.html('').hide();

        var submit = $(this).find("button[type=submit]");

        submit.attr('disabled', 'disabled');

        $.ajax({

            url: $(this).attr('action'),

            type: $(this).attr('method'),

            data: $(this).serialize(),

            success: function(response){

                console.log(response);

                var data = response;

                if(IsJsonString(response) == true){

                    data = JSON.parse(response);

                }

                var msg = "Something Went Wrong";

                if(data.error === true){

                    if(data.message != ""){

                        msg = data.message;

                    }

                    formResponse.html("<div class='alert alert-danger'>" + msg + "</div>").show();

                    submit.removeAttr('disabled');

                }else{

                    msg = "Success";

                    if(data.message != ""){

                        msg = data.message;

                    }

                    formResponse.html("<div class='alert alert-success'>" + msg + "</div>").show();

                }

                if (typeof data.url !== 'undefined' && data.url != "") {

                    window.location.href = data.url;

                }else{

                    submit.removeAttr('disabled');

                }

            }

        });

    });


    $("#checkoutProceedBtn").on("click", function(e){

        e.preventDefault();

        $("#paymentMethodError").html('').hide();

        var selectedPaymentMethod = $("input[type=radio][name=paymentMethod]:checked");

        if (typeof selectedPaymentMethod.val() === 'undefined') {

            $("#paymentMethodError").show();

        }else{

            $("#checkoutProceed input[type=hidden][name=paymentMethod]").val(selectedPaymentMethod.val());

            var deliveryTime = $("input[type=radio][name=deliverTime]:checked").val();

            var deliverDay = $("input[type=radio][name=deliverDay]:checked").val();

            $("#checkoutProceed input[type=hidden][name=deliveryTime]").val(deliveryTime + " - " + deliverDay);

        }

    });
    <!-- favourite -->
    $('body').on('click', ".saved", function(){
        var i = $(this);
        i.removeClass('saved').addClass('save');
        $.post(home + "favourite-post/remove",{
            id: i.data('id')
        },
        function(data, status){
            if(data == "login"){
                window.location.href = home + "login";
            }else{
                try {
                    var r = JSON.parse(data);
                    console.log(data);
                    if((r.error ?? true) == true){
                        i.removeClass('saved').addClass('save');
                    }
                }catch (e) {
                    i.removeClass('saved').addClass('save');
                }
            }
        });
    });
    $('body').on('click', ".save", function(){
        var i = $(this);
        i.removeClass('save').addClass('saved');
        $.post(home + "favourite-post/add",{
            id: i.data('id')
        },
        function(data, status){
            if(data == "login"){
                window.location.href = home + "login";
            }else{
                try {
                    var r = JSON.parse(data);
                    console.log(data);
                    if((r.error ?? true) == true){
                        i.removeClass('save').addClass('saved');
                    }
                }catch (e) {
                    i.removeClass('save').addClass('saved');
                }
            }
        });
    });
    <!-- end favourite -->
    
    $('.variant .btn').on("click", function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var v = $(this).find('input[type=radio][name=options]').data();
        $("#child_" + id).val(v.id);
        $('#qtyPicker_' + id).attr('data-max', v.stock);
        $('#qtyPicker_' + id).attr('max', v.stock).change();
        if (v.mrp != "") {
            $('#price_mrp_' + id).show().find('.value').html(v.mrp);
            $('#price_savings_' + id).show().find('.value').html(v.savings);
            $("#price_offer_" + id).show().find('.value').html(v.price).show();
            $('#price_regular_' + id).hide();
        } else {
            $('#price_mrp_' + id).hide();
            $('#price_savings_' + id).hide();
            $('#price_offer_' + id).hide();
            $('#price_regular_' + id).show().find('.value').html(v.price);
        }
    });
    
    $('form').each(function(index, value) {
        $(this).find('.variant .btn:first').click();
    });
    
    $(".qtyPicker").on("change", function() {
        if (parseInt($(this).val()) < 1) {
            $(this).val(1);
        }else if(parseInt($(this).val()) >= $(this).data('max')){
            $(this).val($(this).data('max'));
        }
    });

    $("select[name=varient]").on("change", function(e) {
        var id = $(this).data('id');
        var selected = $(this).find('option:selected');
        $("#price_" + id).html(selected.data('price'));
        $("#mrp_" + id).html(selected.data('mrp'));
        $("#savings_" + id).html(selected.data('savings'));
    });

    $('.footerfix').css('min-height',$(window).height()-525);

    <!-- home pade side menu category -->
    $("#navContainer").on("click", "li", function(){
        $(this).children("ul").toggleClass("active");
        $("#navContainer li").not(this).children("ul").removeClass("active");
    });

    <!-- sub-header -->
    $('.dropdown').on("hover", function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
    }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
    });

    $('#myCarouselArticle').carousel({
        interval: 10000
    });

    $("#address").addClass("address-show");

    $("#editAddress").addClass("address-hide");

    $("#addAddress").addClass("address-hide");

    $("#dateError").addClass("error-hide");

    $("#timeError").addClass("error-hide");

    $("#paymentError").addClass("error-hide");

    $("#otp-error").addClass("error-hide");

    $("#otpError").addClass("error-hide");

    $("#errorResetPassword").addClass("error-hide");

    $("#registerError").addClass("error-hide");

    $("#cardOtp").addClass("card-hide");

    $("#cardResetPassword").addClass("card-hide");

    $("#registerError").addClass("error-hide");

    $("#backToLogin").addClass("error-hide");

    $('a[data-confirm]').on("click", function(ev) {

        var href = $(this).attr('href');

        $('#orderConfirm').find('.modal-title').text($(this).attr('data-confirm'));

        $('#modal-btn-yes').attr('href', href);

        $('#orderConfirm').modal({show:true});

        return false;

    });


    $('a[data-confirm]').on("click", function(ev) {

        var href = $(this).attr('href');

        $('#modal').find('.modal-title').text($(this).attr('data-confirm'));

        $('#modal-btn-yes').attr('href', href);

        $('#modal').modal({show:true});

        return false;
    });


    $(window).on("scroll", function () {
        if($(this).scrollTop() > 200){
            $("#scroll").fadeIn();
        }else{
            $("#scroll").fadeOut();
        }
    });
    $("#scroll").on("click", function () {
        return $("html, body").animate({ scrollTop: 0 }, 600);
    });

    $('#list').click(function(event){event.preventDefault();$('#products .item1').addClass('list-group-item');});
    $('#grid').click(function(event){event.preventDefault();$('#products .item1').removeClass('list-group-item');$('#products .item1').addClass('grid-group-item');});
    $("#sort").on("change", function(e){
        $("input[type=hidden][name=sort]").val($(this).val());
        $("#filter").submit();
    });
    $(".subs").on("change", function(){
        var sub_ids = [];
        $('.subs:checked').each(function(){
            sub_ids.push($(this).val());
        });
        if(sub_ids.length > 0){
            $("#filter input[type=hidden][name=sub-category]").val(sub_ids.join(","));
            $("#filter").submit();
        }
    });
    $(".cats").on("change", function(){
        var cat_ids = [];
        $('.cats:checked').each(function(){
            cat_ids.push($(this).val());
        });
        if(cat_ids.length > 0){
            $("#filter input[type=hidden][name=category]").val(cat_ids.join(","));
            $("#filter").submit();
        }
    });
    var slider = $("#slider-range");
    slider.slider({
        range: true,
        min: slider.data('min'),
        max: slider.data('max'),
        values: [ slider.data('selected-min'), slider.data('selected-max') ],
        slide: function( event, ui ) {
            $( "input[type=number][name=min_price]" ).val(ui.values[ 0 ]);
		    $( "input[type=number][name=max_price]" ).val(ui.values[ 1 ]);
        }
    });
    $("#filter").on("submit", function(){
        $(this).find("button[type=submit]").click();
    });
});

function loadOptions(element, url, clear = false, open = false, triggerChange = false, selected = 0){
    if(clear == true){
        element.find('option').remove();
    }
    $.ajax({
        url: url,
        success: function(response){
            var data = JSON.parse(response);
            $.each(data, function(id, item){
                if(element.val() != item.id){
                    var isSelected = false;
                    if(selected == item.id){
                        isSelected = true;
                    }
                    element.append(new Option(item.name, item.id, isSelected, isSelected));
                }
            });
            element.select2('close');
            if(open == true){
                element.select2('open');
            }
            if(triggerChange == true){
                element.trigger('change');
            }
        }
    });
}
function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}
function address() {
    if ($("#address").hasClass('address-show')) {
        $("#addAddress").removeClass("address-hide");
        $("#addAddress").addClass("address-show");
        $("#address").removeClass("address-show");
        $("#address").addClass("address-hide");
    } else {
        $("#editAddress").addClass("address-hide");
        $("#addAddress").addClass("address-show");
    }
}
function copycode(){
    /* Get the text field */
    var copyText = document.getElementById("referCode");

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /*For mobile devices*/

    /* Copy the text inside the text field */
    document.execCommand("copy");

}