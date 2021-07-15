<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

$vid = "demo";
$vid = "demo";

$order = "ORDS" . rand(10000, 99999999);
$total_price = (float)$tmp['final_total'];
$callback = env('APP_URL', 'default_value') . "ipay/success";
$environment = 0; //0 for test & 1 for live
$fields = array(
    "live" => $environment,
    "oid" => $order,
    "inv" => $order,
    "ttl" => $total_price,
    "tel" => $loggedInUser['mobile'],
    "eml" => $loggedInUser['email'],
    "vid" => $vid,
    "curr" => "KES",
    "cbk" => $callback,
    "crl" => "2"
);
$datastring = $fields['live'] . $fields['oid'] . $fields['inv'] . $fields['ttl'] . $fields['tel'] . $fields['eml'] . $fields['vid'] . $fields['curr'] . $fields['cbk'] . $fields['crl'];
$hashkey = "demoCHANGED";
$generated_hash = hash_hmac('sha1', $datastring, $hashkey);
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Merchant Check Out Page</title>
    <meta name="GENERATOR" content="Evrsoft First Page">
</head>
<body>
<center><h1>Please do not refresh this page...</h1></center>

<form method="POST" action="https://payments.ipayafrica.com/v3/ke">
    <input type="hidden" name="live" value="{{$environment}}">
    <input type="hidden" name="oid" value="{{$order}}">
    <input type="hidden" name="inv" value="{{$order}}">
    <input type="hidden" name="ttl" value="{{ (float)$total_price }}">
    <input type="hidden" name="tel" value="{{$loggedInUser['mobile']}}">
    <input type="hidden" name="eml" value="{{$loggedInUser['email']}}">
    <input type="hidden" name="vid" value="{{$vid}}">
    <input type="hidden" name="curr" value="KES">
    <input type="hidden" name="crl" value="2">
    <input type="hidden" name="cbk" value="{{$callback}}">
    <input type="hidden" name="actualtotal"
           value="{{ (float)$total_price }}">
    <input name="amount" type="hidden"
           value="{{ (float)$total_price }}">
    <input name="hsh" type="hidden" value="{{$generated_hash}}">
    <button type="submit" id="ipay_button" class="btn btn-dark payment_btns"
            style="display: none">{{__('msg.order_now')}}</button>
</form>
<script>
    "use strict";
    window.onload = function () {
        document.forms[0].submit();
    }
</script>
</body>
</html>
