<?php

namespace App\Http\Controllers\Payments;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MidtransController extends CartController{
    
    public function index(){

        $paymentMethods = Cache::get('payment_methods');

        if(isset($paymentMethods->midtrans_payment_method) && $paymentMethods->midtrans_payment_method == 1){

            $tmp = session()->get('tmp_payment');

            $tmp[get('api-params.status')] = get('api-params.order-status.awaiting-payment');

            $order = $this->order_placed($tmp);

            if(($order['success'] ?? false) == true){

                $orderId = $order['data']['order_id'];

                $response = $this->post('midtrans-order', ['data' => ['order_id' => $orderId, 'gross_amount' => $tmp['total'] ?? 1]]);

                if(trim($response['redirect_url'] ?? '') != ""){

                    header("Location: $response[redirect_url]");
                    die();

                }elseif(($response['error'] ?? false) == true && trim($response['message']) != ""){

                    return redirect()->back()->with('err', $response['message']);

                }

            }

        }
        
        return redirect()->route('checkout-payment')->with('err', msg('select_payment_method'));
    
    }

    public function complete(Request $request, $type = "cancel", $orderId = ""){

        $error = "Payment either cancelled / failed to initialize. Try again or try some other payment method. Thank you";

        $amount = 0;
        
        if($type == "success"){
            
            if(trim($orderId) != ""){

                $paymentMethods = Cache::get('payment_methods');


            }

            $this->add_transaction($orderId, "paypal", $orderId, false, $error, $amount);

            return redirect()->route('checkout-payment')->with('err', $error);

        }
        
        return redirect()->route('checkout-payment')->with('err', $error);

    }

}