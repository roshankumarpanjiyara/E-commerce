<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class UserOrderController extends Controller
{
    //my orders
    public function myOrders(){
        $orders = Order::where('user_id',Auth::id())->orderBy('id','DESC')->paginate(5);
        return view('user.order.my_order',compact('orders'));
    }

    //order details
    public function orderDetails($order_id, $order_number){
        $order = Order::with('state', 'district', 'pincode', 'user')->where('id',$order_id)->where('order_number',$order_number)->where('user_id',Auth::id())->first();
        $orderItems = OrderItem::with('order','product')->where('order_id',$order->id)->orderBy('id','DESC')->get();
        return view('user.order.order_view',compact('order','orderItems'));
    }

    //invoice download
    public function invoiceDownload($order_id, $order_number){
        $order = Order::with('state', 'district', 'pincode', 'user')->where('id',$order_id)->where('order_number',$order_number)->where('user_id',Auth::id())->first();
        $orderItems = OrderItem::with('order','product')->where('order_id',$order->id)->orderBy('id','DESC')->get();

        $pdf = Pdf::loadView('user.order.order_invoice', compact('order','orderItems'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

        // return view('user.order.order_invoice',compact('order','orderItems'));
    }

    //return reason
    public function returnOrderReason(Request $request,$order_id){
        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('D, d F Y'),
            'return_reason' => $request->return_reason,
        ]);

        toast('Return Request Successfully, Thank You For Shopping!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return Redirect()->route('return.order.list');
    }

    //return order list
    public function returnOrderList(){
        $orders = Order::where('user_id',Auth::id())->where('return_reason','!=',NULL)->orderBy('id','DESC')->paginate(5);
        return view('user.order.return',compact('orders'));
    }

    //cancel order list
    public function cancelOrderList(){
        $orders = Order::where('user_id',Auth::id())->where('status','Cancel')->orderBy('id','DESC')->paginate(5);
        return view('user.order.cancel',compact('orders'));
    }

    //cancel order
    public function cancelOrder($order_id){
        Order::findOrFail($order_id)->update([
            'status' => 'Cancel',
            'cancel_date' => Carbon::now()->format('D, d F Y'),
        ]);
        toast('Order Cancel!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return Redirect()->route('cancel.order.list');
    }
}
