<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\Order as MailOrder;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CashController extends Controller
{
    public function cashOrder(Request $request){
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
            'payment_type' => 'Cash',
            'payment_method' => 'Cash On Delivery',
            'currency' => 'USD',
            'subtotal' => $subtotal,
            'discount' => $discount,
            'tax' => $tax,
            'amount' => $total_amount,
            'order_number' => 'OD'.Auth::user()->id.round($total_amount).mt_rand(1000000000,9999999999),
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
            'payment_type' => 'Cash On Delivery'
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
