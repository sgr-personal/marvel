<?php

namespace App\Http\Controllers\Payments;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PaystackController extends CartController{
        
    public function index(){

        $paymentMethods = Cache::get('payment_methods');

        $session = session()->get('tmp_payment');

        $loggedInUser = session()->get('user');

        if(isset($paymentMethods->paystack_payment_method) && $paymentMethods->paystack_payment_method == 1){

            return view('payment-gateways.paystack', compact('paymentMethods', 'session', 'loggedInUser'));

        }else{

            return redirect()->route('checkout-payment')->with('err', msg('select_payment_method'));
            
        }

    }

    public function complete(Request $request, $type = "cancel"){

        $error = "Payment either cancelled / failed to initialize. Try again or try some other payment method. Thank you";

        $amount = 0;

        if($type == "success"){


            $orderId = $request->get('reference', '');

            if(trim($orderId) != ""){

                $paymentMethods = Cache::get('payment_methods');

                $secret_key = $paymentMethods->paystack_secret_key;

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$orderId,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                        "Authorization: Bearer $secret_key"
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                $response = \json_decode($response);

                if(($response->status ?? false)){

                    $tx_ref = $response->data->reference ?? '';

                    $status = $response->data->status ?? 'unknown';

                    $order = $this->order_placed($request->session()->get('tmp_payment'));
                        
                    $amount = $response->data->amount ?? 0;

                    $msg = $response->message ?? '';

                    if($order['success']){

                        $orderId = $order['data']['order_id'] ?? "";

                        if(intval($orderId)){
        
                            $this->add_transaction($order['data']['order_id'], "paystack", $tx_ref ?? '', true, $status, $amount);
        
                            return redirect()->route('my-orders')->with('suc', $order['message'] ?? $msg);
        
                        }

                    }else{

                        $error = $order['message'];
                    }

                }else{

                    $this->add_transaction($orderId, "paystack", $orderId, false, $response->error ?? 'Something Went Wrong', $amount);

                }

            }

            return redirect()->route('checkout-payment')->with('err', $error);

        }
        
        return redirect()->route('checkout-payment')->with('err', $error);

    }

}