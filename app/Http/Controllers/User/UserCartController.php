<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Coupon;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserCartController extends Controller
{
    //my cart
    public function myCart(){
        return view('user.cart.mycart');
    }

    //get cart product
    public function getCartProduct(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();
        $cartSubTotal = Cart::subtotal();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,
            'cartSubTotal' => $cartSubTotal,
        ));
    }

    //remove cart item
    public function removeCartItem($rowId){
        Cart::remove($rowId);

        if(Session::has('coupon')){
            Session::forget('coupon');
        }

        return response()->json(['success' => 'Successfully removed from your cart!!']);
    }

    //quantity increment
    public function qtyIncrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);

        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('name',$coupon_name)->first();
            Session::put('coupon',[
                'coupon_name' => $coupon->name,
                'discount' => $coupon->discount,
                'discount_amount' => number_format(Cart::totalFloat() * $coupon->discount/100,2,".",","),
                'total_amount' => number_format(Cart::totalFloat() - Cart::totalFloat() * $coupon->discount/100,2,".",",")
            ]);
        }

        return response()->json(['success' => 'Quantity increased by 1!!']);
    }

    //quantity increment
    public function qtyDecrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);

        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('name',$coupon_name)->first();
            Session::put('coupon',[
                'coupon_name' => $coupon->name,
                'discount' => $coupon->discount,
                'discount_amount' => number_format(Cart::totalFloat() * $coupon->discount/100,2,".",","),
                'total_amount' => number_format(Cart::totalFloat() - Cart::totalFloat() * $coupon->discount/100,2,".",",")
            ]);
        }

        return response()->json(['success' => 'Quantity decreased by 1!!']);
    }

    //coupon apply
    public function couponApply(Request $request){
        $coupon = Coupon::where('name',$request->coupon_name)->where('validity','>=',Carbon::now()->format('Y-m-d'))->where('status',1)->first();
        if($coupon){
            Session::put('coupon',[
                'coupon_name' => $coupon->name,
                'discount' => $coupon->discount,
                'discount_amount' => number_format(Cart::totalFloat() * $coupon->discount/100,2,".",","),
                'total_amount' => number_format(Cart::totalFloat() - Cart::totalFloat() * $coupon->discount/100,2,".",",")
            ]);
            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Applied Successfully'
            ));
        }else{
            return response()->json(['error' => 'Invalid Coupon!!']);
        }
    }

    //coupon calculation
    public function couponCalculation(){
        if(Session::has('coupon')){
            return response()->json(array(
                'subtotal' => Cart::subtotal(),
                'total' => Cart::total(),
                'tax' => Cart::tax(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'discount' => session()->get('coupon')['discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }else{
            return response()->json(array(
                'wc_subtotal' => Cart::subtotal(),
                'wc_total' => Cart::total(),
                'wc_tax' => Cart::tax()
            ));
        }
    }

    //coupon remove
    public function CouponRemove(){
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Removed']);
    }


    //checkout create
    public function checkoutCreate(){
        if(Auth::check()){
            if(Cart::total() > 0){
                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();
                $cartSubTotal = Cart::subtotal();
                $states = State::orderBy('name','ASC')->get();
                return view('user.checkout.view',compact('carts','cartQty','cartTotal','cartSubTotal','states'));
            }else{
                toast('Please Add Product To Your Cart!','error')->autoClose(5000)->width('450px')->timerProgressBar();
                return redirect()->to('/');
            }
        }else{
            toast('Login Needed!','error')->autoClose(5000)->width('450px')->timerProgressBar();
            return redirect()->route('login');
        }
    }

    //coupon calculation checkout
    public function couponCalculationCheckout(){
        if(Session::has('coupon')){
            return response()->json(array(
                'total' => Cart::total(),
                'tax' => Cart::tax(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'discount' => session()->get('coupon')['discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }else{
            return response()->json(array(
                'wc_tax' => Cart::tax(),
                'wc_total' => Cart::total(),
            ));
        }
    }
}
