<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    //add to cart
    public function addToCart(Request $request, $id){

        if(Session::has('coupon')){
            Session::forget('coupon');
        }

        $product = Product::findOrFail($id);

        if($product->discount_price == null){
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'sku' => $product->product_sku,
                    'slug' => $product->product_slug,
                    'brand_name' => $product->brand->name,
                    'size' => $request->size
                ]
            ]);
            return response()->json(['success' => 'Successfully added to your cart!']);
        }else{
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'sku' => $product->product_sku,
                    'slug' => $product->product_slug,
                    'brand_name' => $product->brand->name,
                    'size' => $request->size
                ]
            ]);
            return response()->json(['success' => 'Successfully added to your cart!']);
        }
    }

    //minicart
    public function productMiniCart(){
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

    //remove mini cart item
    public function removeMiniCartItem($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Successfully removed from your cart!']);
    }

    //add to wishlist
    public function addToWishlist(Request $request, $product_id){
        if(Auth::check()){
            $exits = Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();

            if (!$exits){
                Wishlist::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                ]);
                return response()->json(['success' => 'Successfully added to your wishlist!']);
            }else{
                return response()->json(['error' => 'Product already exits!']);
            }
        }else{
            return response()->json(['error' => 'Login Needed!!']);
        }
    }
}
