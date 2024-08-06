<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Paypal;
 
class PaypalController extends Controller
{
 
    public $gateway;
 
   //создание объекта с настройками приложения
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId('AS6FH33GXitGrVxV-nfM3SQTStY27yD9e5KLcoXRjqBlARsGiuXU1vA7nLNJxksCV39SFJeblXnKWgRz');
        $this->gateway->setSecret('EL-PjamJVm3VUWG2nsI42Lwwh3wt-Y9OEuZ400D3PC9SPD1dCh6gS79spWYQDwLAhtA_FhwOPSxG6Vl9');
        $this->gateway->setTestMode(true); // для реальных платежей нужно будет ставить false 
    }
 
    public function index()
    {
        return view('paypal');
    }
 
   //отправляем платеж в Paypal
    public function charge(Request $request)
    {
        if($request->input('submit'))
        {
            try {
                $response = $this->gateway->purchase(array(
                    'amount' => $request->input('amount'),
                    'currency' => 'EUR', //если доллары то пишем здесь USD
                    'returnUrl' => url('paypalsuccess'), // если платеж прошел удачно
                    'cancelUrl' => url('paypalerror'), // если ошибка, то перейдет на этот рут
                ))->send();
 
                if ($response->isRedirect()) {
                    $response->redirect(); // this will automatically forward the customer
                } else {
                    // not successful
                    return $response->getMessage();
                }
            } catch(Exception $e) {
                return $e->getMessage();
            }
        }
    }
 
// если платеж прошел удачно
    public function paypal_success(Request $request)
    {
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paypalId') && $request->input('PayerID'))
        {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paypalId'),
            ));
            $response = $transaction->send();
 
            if ($response->isSuccessful())
            {
                // The customer has successfully paid.
                $arr_body = $response->getData();
 
                // Insert transaction data into the database
                $isPaypalExist = Paypal::where('payment_id', $arr_body['id'])->first();
 
                if(!$isPaypalExist)
                {
                    $paypal = new Paypal;
                    $paypal->payment_id = $arr_body['id'];
                    $paypal->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                    $paypal->payer_email = $arr_body['payer']['payer_info']['email'];
                    $paypal->amount = $arr_body['transactions'][0]['amount']['total'];
                    $paypal->currency = 'EUR'; //если доллары то пишем здесь USD
                    $paypal->payment_status = $arr_body['state'];
                    $paypal->save();
                }
 
                return "Payment is successful. Your transaction id is: ". $arr_body['id'];
            } else {
                return $response->getMessage();
            }
        } else {
            return 'Transaction is declined';
        }
    }
   // если ошибка 
    public function paypal_error()
    {
        return 'User is canceled the payment.';
    }
 
}