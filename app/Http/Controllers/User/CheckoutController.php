<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\PostalCode;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    //get district with ajax
    public function getDistrict($state_id)
    {
        $district = District::where('state_id',$state_id)->orderBy('name','ASC')->get();
        return json_encode($district);
    }

    //get pincode with ajax
    public function getPincode($district_id)
    {
        $pincode = PostalCode::where('district_id',$district_id)->orderBy('pincode','ASC')->get();
        return json_encode($pincode);
    }

    //checkout store
    public function checkoutStore(Request $request){
        $this->validate($request,[
            'shipping_name'=>'required|max:50',
            'shipping_email'=>'required',
            'shipping_phone'=>'required|numeric|digits:10',
            'shipping_address'=>'required'
        ]);
        // dd($request->all());
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address." ".$request->shipping_address_2;
        $data['notes'] = $request->notes;
        $data['state_id'] = $request->state_id;
        $data['district_id'] = $request->district_id;
        $data['pincode_id'] = $request->pincode_id;
        // $data['user_id'] = Auth::user()->id;
        $cartTotal = Cart::total();
        $cartSubTotal = Cart::subtotal();
        $cartTax = Cart::Tax();

        if($request->payment_method == 'stripe'){
            return view('frontend.payment.stripe',compact('data','cartTotal','cartSubTotal','cartTax'));
        }else if($request->payment_method == 'card'){
            return "card";
        }else{
            return view('frontend.payment.cash',compact('data','cartTotal','cartSubTotal','cartTax'));
        }
    }
}
