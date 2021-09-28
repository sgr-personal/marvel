<?php

namespace App\Http\Controllers;
ini_set('memory_limit', -1);

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Razorpay\Api\Api;

use function GuzzleHttp\json_encode;

function encrypt_e($input, $ky)
{
    $key = html_entity_decode($ky);
    $iv = "@@@@&&&&####$$$$";
    $data = openssl_encrypt($input, "AES-128-CBC", $key, 0, $iv);
    return $data;
}

function decrypt_e($crypt, $ky)
{
    $key = html_entity_decode($ky);
    $iv = "@@@@&&&&####$$$$";
    $data = openssl_decrypt($crypt, "AES-128-CBC", $key, 0, $iv);
    return $data;
}

function generateSalt_e($length)
{
    $random = "";
    srand((double)microtime() * 1000000);

    $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
    $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
    $data .= "0FGH45OP89";

    for ($i = 0; $i < $length; $i++) {
        $random .= substr($data, (rand() % (strlen($data))), 1);
    }

    return $random;
}

function checkString_e($value)
{
    if ($value == 'null')
        $value = '';
    return $value;
}

function getChecksumFromArray($arrayList, $key, $sort = 1)
{
    if ($sort != 0) {
        ksort($arrayList);
    }
    $str = getArray2Str($arrayList);
    $salt = generateSalt_e(4);
    $finalString = $str . "|" . $salt;
    $hash = hash("sha256", $finalString);
    $hashString = $hash . $salt;
    $checksum = encrypt_e($hashString, $key);
    return $checksum;
}

function getChecksumFromString($str, $key)
{

    $salt = generateSalt_e(4);
    $finalString = $str . "|" . $salt;
    $hash = hash("sha256", $finalString);
    $hashString = $hash . $salt;
    $checksum = encrypt_e($hashString, $key);
    return $checksum;
}

function verifychecksum_e($arrayList, $key, $checksumvalue)
{
    $arrayList = removeCheckSumParam($arrayList);
    ksort($arrayList);
    $str = getArray2StrForVerify($arrayList);
    $paytm_hash = decrypt_e($checksumvalue, $key);
    $salt = substr($paytm_hash, -4);

    $finalString = $str . "|" . $salt;

    $website_hash = hash("sha256", $finalString);
    $website_hash .= $salt;

    $validFlag = "FALSE";
    if ($website_hash == $paytm_hash) {
        $validFlag = "TRUE";
    } else {
        $validFlag = "FALSE";
    }
    return $validFlag;
}

function verifychecksum_eFromStr($str, $key, $checksumvalue)
{
    $paytm_hash = decrypt_e($checksumvalue, $key);
    $salt = substr($paytm_hash, -4);

    $finalString = $str . "|" . $salt;

    $website_hash = hash("sha256", $finalString);
    $website_hash .= $salt;

    $validFlag = "FALSE";
    if ($website_hash == $paytm_hash) {
        $validFlag = "TRUE";
    } else {
        $validFlag = "FALSE";
    }
    return $validFlag;
}

function getArray2Str($arrayList)
{
    $findme = 'REFUND';
    $findmepipe = '|';
    $paramStr = "";
    $flag = 1;
    foreach ($arrayList as $key => $value) {
        $pos = strpos($value, $findme);
        $pospipe = strpos($value, $findmepipe);
        if ($pos !== false || $pospipe !== false) {
            continue;
        }

        if ($flag) {
            $paramStr .= checkString_e($value);
            $flag = 0;
        } else {
            $paramStr .= "|" . checkString_e($value);
        }
    }
    return $paramStr;
}

function getArray2StrForVerify($arrayList)
{
    $paramStr = "";
    $flag = 1;
    foreach ($arrayList as $key => $value) {
        if ($flag) {
            $paramStr .= checkString_e($value);
            $flag = 0;
        } else {
            $paramStr .= "|" . checkString_e($value);
        }
    }
    return $paramStr;
}

function redirect2PG($paramList, $key)
{
    $hashString = getchecksumFromArray($paramList);
    $checksum = encrypt_e($hashString, $key);
}

function removeCheckSumParam($arrayList)
{
    if (isset($arrayList["CHECKSUMHASH"])) {
        unset($arrayList["CHECKSUMHASH"]);
    }
    return $arrayList;
}

function getTxnStatus($requestParamList)
{
    return callAPI(PAYTM_STATUS_QUERY_URL, $requestParamList);
}

function getTxnStatusNew($requestParamList)
{
    return callNewAPI(PAYTM_STATUS_QUERY_NEW_URL, $requestParamList);
}

function initiateTxnRefund($requestParamList)
{
    $CHECKSUM = getRefundChecksumFromArray($requestParamList, PAYTM_MERCHANT_KEY, 0);
    $requestParamList["CHECKSUM"] = $CHECKSUM;
    return callAPI(PAYTM_REFUND_URL, $requestParamList);
}

function callAPI($apiURL, $requestParamList)
{
    $jsonResponse = "";
    $responseParamList = array();
    $JsonData = json_encode($requestParamList);
    $postData = 'JsonData=' . urlencode($JsonData);
    $ch = curl_init($apiURL);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($postData))
    );
    $jsonResponse = curl_exec($ch);
    $responseParamList = json_decode($jsonResponse, true);
    return $responseParamList;
}

function callNewAPI($apiURL, $requestParamList)
{
    $jsonResponse = "";
    $responseParamList = array();
    $JsonData = json_encode($requestParamList);
    $postData = 'JsonData=' . urlencode($JsonData);
    $ch = curl_init($apiURL);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($postData))
    );
    $jsonResponse = curl_exec($ch);
    $responseParamList = json_decode($jsonResponse, true);
    return $responseParamList;
}

function getRefundChecksumFromArray($arrayList, $key, $sort = 1)
{
    if ($sort != 0) {
        ksort($arrayList);
    }
    $str = getRefundArray2Str($arrayList);
    $salt = generateSalt_e(4);
    $finalString = $str . "|" . $salt;
    $hash = hash("sha256", $finalString);
    $hashString = $hash . $salt;
    $checksum = encrypt_e($hashString, $key);
    return $checksum;
}

function getRefundArray2Str($arrayList)
{
    $findmepipe = '|';
    $paramStr = "";
    $flag = 1;
    foreach ($arrayList as $key => $value) {
        $pospipe = strpos($value, $findmepipe);
        if ($pospipe !== false) {
            continue;
        }

        if ($flag) {
            $paramStr .= checkString_e($value);
            $flag = 0;
        } else {
            $paramStr .= "|" . checkString_e($value);
        }
    }
    return $paramStr;
}

function callRefundAPI($refundApiURL, $requestParamList)
{
    $jsonResponse = "";
    $responseParamList = array();
    $JsonData = json_encode($requestParamList);
    $postData = 'JsonData=' . urlencode($JsonData);
    $ch = curl_init($apiURL);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_URL, $refundApiURL);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $jsonResponse = curl_exec($ch);
    $responseParamList = json_decode($jsonResponse, true);
    return $responseParamList;
}

class CartController extends Controller
{

    public function index()
    {

        if (!isLoggedIn()) {

            return redirect()->route('login');

        } else {

            $data = $this->getCart();

            $data['title'] = __('msg.cart');

            $this->html('cart', $data);


        }

    }

    public function getLastUrl()
    {

        $lastUrlName = "";

        try {

            $lastUrl = app('request')->create(url()->previous(), 'GET');

            $lastUrlName = app('router')->goroutes()->match($lastUrl)->getName() ?? '';

        } catch (\Exception $e) {

            $lastUrlName = "";

        } catch (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e) {

            $lastUrlName = "";

        }

        return $lastUrlName;

    }

    public function add(Request $request)
    {

        if (!isLoggedIn()) {

            $request->session()->put('tmp_cart', $request->all());

            return redirect()->route('login');

        } else {

            $lastUrlName = $this->getLastUrl();

            if ($lastUrlName == "login" && $request->session()->has('tmp_cart')) {

                $tmp = $request->session()->get('tmp_cart');

                if (isset($tmp['id']) && intval($tmp['id']) && isset($tmp['varient']) && intval($tmp['varient'])) {

                    $request->id = $tmp['id'];

                    $request->child_id = $tmp['varient'];

                }

            }

            return $this->addToCart($request);

        }

    }

    public function addToCart(Request $request, $lastUrlName = "")
    {

        $result = $this->post('cart', ['data' => ['add_to_cart' => 1, 'user_id' => session()->get('user')['user_id'], 'product_id' => $request->id, 'product_variant_id' => $request->child_id, 'qty' => $request->qty ?? 1]]);

        $return = false;

        if ($result['error']) {

            if ($lastUrlName == 'login') {

                $return = redirect()->route('cart')->with('err', $result['message']);

            } else {

                $return = redirect()->back()->with('err', $result['message']);

            }

        } else {

            $request->session()->forget('tmp_cart');

            if ($request->has('submit') && $request->submit == "buynow") {

                $return = redirect()->route('cart')->with('suc', $result['message']);

            } else {

                $return = redirect()->back()->with('suc', $result['message']);

            }

        }

        return $return;

    }

    public function add_single_varient(Request $request)
    {

        return $this->add_single($request, $request->id, $request->varient);

    }

    public function add_single(Request $request, $id, $varient_id)
    {

        if (!isLoggedIn()) {

            $request->session()->put('last-url', url()->full());

        }

        $request->id = $id;

        $request->child_id = $varient_id;

        return $this->add($request);

    }

    public function update(Request $request, $id)
    {

        if (!isLoggedIn()) {

            return redirect()->route('login');

        } else {

            $data = ['add_to_cart' => 1, 'user_id' => session()->get('user')['user_id'], 'product_id' => $request->id, 'product_variant_id' => $request->child_id, 'qty' => $request->qty ?? 1];
            $result = $this->post('cart', ['data' => $data]);

            if ($result['error']) {

                return redirect()->back()->with('err', $result['message']);

            } else {

                return redirect()->back()->with('suc', $result['message']);

            }

        }

    }

    public function remove($id)
    {

        if (!isLoggedIn()) {

            return redirect()->route('login');

        } else {

            $data = ['remove_from_cart' => 1, 'user_id' => session()->get('user')['user_id']];

            if (intval($id)) {

                $data['product_variant_id'] = $id;

            }

            $result = $this->post('cart', ['data' => $data]);

            if ($result['error']) {

                return redirect()->back()->with('err', $result['message']);

            } else {

                return redirect()->back()->with('suc', $result['message']);

            }

        }

    }

    public function calc()
    {

        $arr = session('cart');

        $total = 0;

        $shipping = 0;

        $discount = 0;

        $tax_amount = 0;

        if (is_array($arr) && count($arr)) {

            var_dump($arr);
            die();

            foreach ($arr as $a) {

                if (isset($a['varient']->discounted_price) && isset($a['quantity']) && intval($a['quantity'])) {

                    $total += $a['variant']->discounted_price * $a['quantity'];

                }

            }

        }

        if (Cache::has('delivery_charge')) {

            $shipping = floatval(Cache::get('delivery_charge'));

        }

        if (Cache::get('tax') && floatval(Cache::get('tax')) > 0) {

            $tax = number_format(Cache::get('tax'), 2);

            $tax_amount = floatval(floatval(Cache::get('tax')) * session()->get('sub_total') / 100);

        }

        if (session()->has('discount')) {

            $coupon = session()->get('discount');

            if (is_array($coupon) && count($coupon) && floatval($coupon['discount']) > 0) {

                $discount = $coupon['discount'];

            }

        }

        session(['sub_total' => $total, 'shipping' => $shipping, 'tax_percentage' => $tax ?? '', 'tax_amount' => $tax_amount, 'discount' => $discount, 'total' => floatval(floatval($total) - floatval($discount) + floatval($tax_amount) + floatval($shipping))]);

    }

    public function order_placed($data, $clearCart = true)
    {

        $data['order_from'] = '1';

        $response = $this->post('order-process', ['data' => $data]);

        if (isset($response['error']) && $response['error'] == "false") {

            if ($clearCart == true) {

                $this->post('cart', ['data' => ['remove_from_cart' => 1, 'user_id' => session()->get('user')['user_id']]]);

                session()->put('discount', '');

                session()->put('checkout-address', '');

            }

            return ['success' => true, 'message' => $response['message'] ?? msg('order_success'), 'data' => $response];

        } else {

            return ['success' => false, 'message' => $response['message'] ?? msg('order_error')];

        }

    }

    public function checkout_cod($data)
    {

        $response = $this->order_placed($data);

        if ($response['success']) {

            return redirect()->route('my-orders')->with('suc', $response['message'] ?? msg('order_success'));

        } else {

            return redirect()->back()->with('err', $response['message'] ?? msg('order_error'));

        }

    }

    public function checkout_paypal_init(Request $request)
    {

        $paymentMethods = Cache::get('payment_methods');

        if (isset($paymentMethods->paypal_payment_method) && $paymentMethods->paypal_payment_method == 1) {

            $payment_url = "https://www.paypal.com/cgi-bin/webscr";

            if ($paymentMethods->paypal_mode == "sandbox") {

                $payment_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";

            }

            $tmp = $request->session()->get('tmp_paypal');

            return view('payment-gateways.paypal', compact('payment_url', 'paymentMethods', 'tmp'));

        }

    }

    public function checkout_paypal(Request $request, $type = "return")
    {

        if ($type == "return") {

            $error = true;

            $msg = "Payment either cancelled / failed to initialize. Try again or try some other payment method. Thank you";

            if (isset($_GET['amt']) && isset($_GET['st']) && $_GET['st'] == 'Completed') {
                $msg = "Payment completed successfully";
                $error = false;
            } elseif (isset($_GET['amt']) && isset($_GET['st']) && $_GET['st'] == 'Authrize') {
                $msg = "Payment is authorized successfully. Your order will be fulfilled once we capture the transaction.";
                $error = false;
            } elseif (isset($_GET['tx']) && $_GET['tx'] == 'disabled') {
                $msg = "Paypal payment method is not available currently";
            }

            $orderId = "";

            if (!$error) {

                $response = $this->order_placed($request->session()->get('tmp_paypal'));

                $orderId = $response['data']['order_id'] ?? "";

                if (intval($orderId)) {

                    $this->add_transaction($response['data']['order_id'], "paypal", $request->item_number ?? '', true, $msg, $request->amt ?? 0);

                    return redirect()->route('my-orders')->with('suc', $response['message'] ?? $msg);

                }

            }

            $this->add_transaction($orderId, "paypal", $request->item_number ?? '', false, $msg, $request->amt ?? 0);

            return redirect()->route('checkout-payment')->with('err', $response['message'] ?? $msg);

        }

        return redirect()->route('checkout-payment')->with('err', $msg);

    }

    public function checkout_payu_bolt_init(Request $request)
    {

        $paymentMethods = Cache::get('payment_methods');

        if ($request->has('status') && $request->status == 'failed') {

            return redirect()->route('checkout-payment')->with('err', 'Failed To Make Payment With PayUMoney. Kindly Select Another Option');

        }

        if (isset($paymentMethods->payumoney_payment_method) && $paymentMethods->payumoney_payment_method == 1) {

            $loggedInUser = $request->session()->get('user');

            $tmp = $request->session()->get('tmp_payu');

            $mode = $paymentMethods->payumoney_mode;

            $merchant_key = $paymentMethods->payumoney_merchant_key;

            $salt = $paymentMethods->payumoney_salt;

            $payment_url = ($mode == 'sandbox') ? 'https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js' : 'https://checkout-static.citruspay.com/bolt/run/bolt.min.js';

            $data = ['key' => $merchant_key, 'salt' => $salt, 'txnid' => substr(hash('sha256', getTxnId() . microtime()), 0, 20)];

            $data['amount'] = $tmp['total'];

            $data['firstname'] = $loggedInUser['name'];

            $data['email'] = $loggedInUser['email'];

            $data['phone'] = $loggedInUser['mobile'];

            $data['productinfo'] = get('name');

            $data['surl'] = route('checkout-payu-bolt');

            $data['furl'] = route('checkout-payu-bolt', ['status' => 'failed']);

            $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|||||";

            $hashVarsSeq = explode('|', $hashSequence);

            $hash_string = '';

            foreach ($hashVarsSeq as $hash_var) {

                $hash_string .= isset($data[$hash_var]) ? $data[$hash_var] : '';

                $hash_string .= '|';

            }

            $data['hash'] = strtolower(hash('sha512', $hash_string . $salt));

            $data['payment_url'] = $payment_url;

            return view("payment-gateways.payu-bolt", compact('data'));

        } else {

            return redirect()->route('cart')->with('err', 'Kindly Select Another Payment Method');

        }

    }

    public function checkout_payu_bolt(Request $request)
    {

        if ($request->has('status') && $request->status == 'success') {

            $response = $this->order_placed($request->session()->get('tmp_payu'));

            if ($response['success'] && intval($response['data']['order_id'])) {

                $trans = $this->add_transaction($response['data']['order_id'], "payumoney", $request->txnid ?? '', true, msg('order_success'), $request->amount ?? 0);

                if (isset($trans['error']) && !$trans['error']) {

                    return redirect()->route('my-orders')->with('suc', $response['message'] ?? msg('order_success'));

                } else {

                    return redirect()->route('my-orders')->with('suc', $response['message'] . "<br>" . $trans['message'] ?? msg('order_success'));

                }

            } else {

                $this->add_transaction($response['data']['order_id'], "payumoney", $request->txnid ?? '', true, msg('order_success'), $request->amount ?? 0);

                return redirect()->back()->with('err', $response['message'] ?? msg('order_error'));

            }

        }

    }

    public function add_transaction($orderId = "", $paymentType = "", $txnId = "", $status = true, $message = "", $amount = 0)
    {

        $data = ['add_transaction' => 1, 'user_id' => session()->get('user')['user_id'], 'order_id' => $orderId, 'type' => $paymentType, 'txn_id' => $txnId, 'amount' => $amount, 'status' => ($status ? 'Success' : 'canceled'), 'message' => $message ?? msg('order_success'), 'transaction_date' => date('Y-m-d H:i:s')];

        return $this->post('order-process', ['data' => $data, 'data_param' => '']);

    }

    public function checkout_razorpay_init(Request $request)
    {

        $loggedInUser = $request->session()->get('user');

        $data = $request->session()->get('tmp_razorpay');

        $response = $this->post('razorpay-order', ['data' => ['amount' => $data[api_param('final-total')] * 100, 'user_id' => session()->get('user')['user_id']], 'data_param' => '']);

        if (isset($response['error']) && !$response['error']) {

            return view('payment-gateways.razorpay', compact('response', 'loggedInUser', 'data'));

        } else {

            return redirect()->back()->with('err', $response['message'] ?? msg('order_error'));

        }
    }

    public function checkout_razorpay(Request $request)
    {

        $data = json_decode($request->data);

        $generated_signature = hmac_sha256($data->id . "|" . $request->razorpay_payment_id, Cache::get('payment_methods')->razorpay_secret_key);

        $return = false;

        if ($generated_signature == $request->razorpay_signature) {

            $response = $this->order_placed($request->session()->get('tmp_razorpay'));

            if ($response['success'] && intval($response['data']['order_id'])) {

                $trans = $this->add_transaction($response['data']['order_id'], "razorpay", $request->razorpay_payment_id ?? '', true, msg('order_success'), $request->amount ?? 0);

                if (isset($trans['error']) && !$trans['error']) {

                    $return = redirect()->route('my-orders')->with('suc', $response['message'] ?? msg('order_success'));

                } else {

                    $return = redirect()->route('my-orders')->with('suc', $response['message'] . "<br>" . $trans['message'] ?? msg('order_success'));

                }

            } else {

                $this->add_transaction($response['data']['order_id'], "razorpay", $request->razorpay_payment_id ?? '', true, msg('order_success'), $request->amount ?? 0);

                $return = redirect()->back()->with('err', $response['message'] ?? msg('order_error'));

            }

        } else {

            $return = redirect()->back()->with('err', $response['message'] ?? msg('order_error'));

        }

        return $return;

    }

    public function coupon_apply(Request $request)
    {

        $loggedInUser = session()->get('user');

        $response = array('error' => true, 'message' => 'Enter Coupon Code');

        if ($request->has('coupon') && trim($request->coupon) != "") {

            $data = [];

            $data['validate_promo_code'] = api_param('get-val');

            $data[api_param('user-id')] = $loggedInUser['user_id'];

            $data[api_param('promo-code')] = $request->coupon;

            $data[api_param('total')] = $request->total ?? 0;

            $response = $this->post('validate-promo-code', ['data' => $data]);

            if (!$response['error'] && floatval($response['discount']) > 0) {

                session()->put('discount', $response);

                $response['url'] = route('checkout');

            }

        }

        echo json_encode($response);

    }

    public function coupon_remove()
    {

        session()->put('discount', '');

        $this->calc();

        return redirect()->back();

    }

    public function txnTest(Request $request)
    {
        $paymentMethods = Cache::get('payment_methods');
        $tmp = $request->session()->get('tmp_paytm');
        $tmp[get('api-params.status')] = get('api-params.order-status.awaiting-payment');

        $loggedInUser = $request->session()->get('user');
        $data = $request->session()->get('tmp_paytm');
        return view("payment-gateways.txnTest", compact('loggedInUser', 'data', 'tmp'));
    }

    public function pgRedirect(Request $request)
    {
        header("Pragma: no-cache");
        header("Cache-Control: no-cache");
        header("Expires: 0");
        $checkSum = "";
        $paramList = array();
        $ORDER_ID = $request["ORDER_ID"];
        $CUST_ID = $request["CUST_ID"];
        $INDUSTRY_TYPE_ID = $request["INDUSTRY_TYPE_ID"];
        $CHANNEL_ID = $request["CHANNEL_ID"];
        $TXN_AMOUNT = $request["TXN_AMOUNT"];
        $paymentMethods = Cache::get('payment_methods');
        if (isset($paymentMethods->paytm_payment_method) && $paymentMethods->paytm_payment_method == 1) {
            $mode = $paymentMethods->paytm_mode;
            $paytm_merchant_id = $paymentMethods->paytm_merchant_id;
            $paytm_merchant_key = $paymentMethods->paytm_merchant_key;
            $callback_url = env('APP_URL', 'default_value') . "paytm/success";
            // Create an array having all required parameters for creating checksum.
            $paramList["MID"] = $paytm_merchant_id;
            $paramList["ORDER_ID"] = $ORDER_ID;
            $paramList["CUST_ID"] = $CUST_ID;
            $paramList["INDUSTRY_TYPE_ID"] = "Retail";
            $paramList["CHANNEL_ID"] = "WEB";
            $paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
            $paramList["WEBSITE"] = "WEBSTAGING";
            $paramList["CALLBACK_URL"] = $callback_url;
        }
        //Here checksum string will return by getChecksumFromArray() function.
        $checkSum = getChecksumFromArray($paramList, $paytm_merchant_key);
        return view("payment-gateways.pgRedirect")
            ->with('paramList', $paramList)
            ->with('checkSum', $checkSum);
    }

    public function pgResponse(Request $request)
    {
        $paytmChecksum = "";
        $paramList = array();
        $isValidChecksum = "FALSE";
        $paymentMethods = Cache::get('payment_methods');
        $paytm_merchant_key = $paymentMethods->paytm_merchant_key;
        $paramList = $_POST;
        $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
        $isValidChecksum = verifychecksum_e($paramList, $paytm_merchant_key, $paytmChecksum); //will return TRUE or FALSE string.
        if ($isValidChecksum == "TRUE") {
            echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
            if ($_POST["STATUS"] == "TXN_SUCCESS") {
                echo "<b>Transaction status is success</b>" . "<br/>";
                $transaction_id = $_POST['TXNID'];
                $loggedInUser = $request->session()->get('user');
                $data = $request->session()->get('tmp_paytm');
                $amount = $data['final_total'];
                $msg = "Payment completed successfully";
                $orderId = "";
                $response = $this->order_placed($request->session()->get('tmp_paytm'));
                $orderId = $response['data']['order_id'] ?? "";
                if (intval($orderId)) {
                    $this->add_transaction($response['data']['order_id'], "paytm", $transaction_id, true, $msg, $amount);
                    return redirect()->route('my-orders')->with('suc', $response['message'] ?? $msg);
                }

                $this->add_transaction($orderId, "paytm", $transaction_id, false, $msg, $amount);
                return redirect()->route('checkout-payment')->with('err', $response['message'] ?? $msg);
            }
        } else {
            echo "<b>Transaction status is failure</b>" . "<br/>";
        }
        if (isset($_POST) && count($_POST) > 0) {
            foreach ($_POST as $paramName => $paramValue) {
                echo "<br/>" . $paramName . " = " . $paramValue;
            }
        } else {
            echo "<b>Checksum mismatched.</b>";
        }
    }

    public function ipayTxn(Request $request)
    {

        $paymentMethods = Cache::get('payment_methods');
        $tmp = $request->session()->get('ipay');
        $tmp[get('api-params.status')] = get('api-params.order-status.awaiting-payment');

        $loggedInUser = $request->session()->get('user');
        $data = $request->session()->get('ipay');
        return view("payment-gateways.ipay", compact('loggedInUser', 'data', 'tmp'));
    }

    public function ipayResponse(Request $request)
    {
        if ($request->id) {
            if ($request->status) {
                echo "<b>Transaction status is success</b>" . "<br/>";
                $transaction_id = $request->txncd;
                $loggedInUser = $request->session()->get('user');
                $data = $request->session()->get('ipay');
                $amount = $data['final_total'];
                $msg = "Payment completed successfully";
                $orderId = "";
                $response = $this->order_placed($request->session()->get('ipay'));
                $orderId = $response['data']['order_id'] ?? "";
                if (intval($orderId)) {
                    $this->add_transaction($response['data']['order_id'], "ipay", $transaction_id, true, $msg, $amount);
                    return redirect()->route('my-orders')->with('suc', $response['message'] ?? $msg);
                }

                $this->add_transaction($orderId, "ipay", $transaction_id, false, $msg, $amount);
                return redirect()->route('checkout-payment')->with('err', $response['message'] ?? $msg);
            }
        } else {
            echo "<b>Transaction status is failure</b>" . "<br/>";
        }
    }
}
