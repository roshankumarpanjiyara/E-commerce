<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\Order as MailOrder;
use App\Models\Order;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class StripeController extends Controller
{
    public function stripeOrder(Request $request){
        if(Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
            $b = str_replace( ',', '', $total_amount );
            if( is_numeric( $b ) ) {
                $total_amount = $b;
            } 
            $discount = Session::get('coupon')['discount_amount'];
            $dis = str_replace(',','',$discount);
            if(is_numeric($dis)){
                $discount = $dis;
            }
        }else{
            $total_amount = Cart::totalFloat();
            $discount = 0;
        }
        $subtotal = Cart::subtotal();
        $sub = str_replace(',','',$subtotal);
        if(is_numeric($sub)){
            $subtotal = $sub;
        }

        $tax = Cart::tax();
        $t = str_replace(',','',$tax);
        if(is_numeric($t)){
            $tax = $t;
        }
        // dd($total_amount);
        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51IAvrrJOAl9GMXiBXEUseKEz9wa5bibLTP6EK8H1HNGIoAAPO4gBtaOIhCOd5xWEtRmLc8YG8DdrWshE9y0HV2Tv00DZuSu2PZ');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'shipping' => [
                'name' => $request->name,
                'address' => [
                  'line1' => $request->address,
                  'postal_code' => $request->pincode_id,
                  'city' => $request->district_id,
                  'state' => $request->state_id,
                  'country' => 'US',
                ],
            ],
            'amount' => $total_amount*100,
            'currency' => 'usd',
            'description' => $request->email,
            'source' => $token,
            'metadata' => ['order_id' => 'OD'.Auth::user()->id.round($total_amount).mt_rand(1000000000,9999999999)],
        ]);
        // dd($charge);

        $order_id = Order::insertGetId([
            'user_id' => Auth::user()->id,
            'state_id' => $request->state_id,
            'district_id' => $request->district_id,
            'pincode_id' => $request->pincode_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'notes' => $request->notes,
            'payment_type' => 'Stripe',
            'payment_method' => $charge->payment_method,
            'transaction_id' =>$charge->balance_transaction,
            'currency' => $charge->currency,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'tax' => $tax,
            'amount' => $total_amount,
            'order_number' => $charge->metadata->order_id,
            'invoice_no' => 'ECOM'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('D, d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Pending',
            'created_at' => Carbon::now(),	
        ]);
        // dd($order_id);

        //send mail
        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_no' => $invoice->invoice_no,
            'order_number' => $invoice->order_number,
            'subtotal' => Cart::subtotal(),
            'discount' => $discount,
            'tax' => Cart::tax(),
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email,
            'phone' => $invoice->phone,
            'order_date' => $invoice->order_date,
            'address' => $invoice->address,
            'state' => $invoice->state->name,
            'district' => $invoice->district->name,
            'pincode' => $invoice->pincode->pincode,
            'payment_type' => 'Stripe'
        ];

        Mail::to($request->email)->send(new MailOrder($data));

        $carts = Cart::content();
        foreach($carts as $cart){
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }

        if(Session::has('coupon')){
            Session::forget('coupon');
        }

        Cart::destroy();

        toast('Order Placed Successfully, Thank You For Shopping!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return Redirect()->route('dashboard');
    }
}
