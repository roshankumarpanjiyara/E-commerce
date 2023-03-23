<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    //all orders
    public function allOrders(){
        $orders = Order::orderBy('id','DESC')->get();
        return view('backend.order.all_orders',compact('orders'));
    }

    //pending orders
    public function pendingOrders(){
        $orders = Order::where('status','Pending')->orderBy('id','DESC')->get();
        return view('backend.order.pending.index',compact('orders'));
    }

    //order details
    public function orderDetails($order_id){
        $order = Order::with('state', 'district', 'pincode', 'user')->where('id',$order_id)->first();
        $orderItems = OrderItem::with('order','product')->where('order_id',$order->id)->orderBy('id','DESC')->get();
        return view('backend.order.details',compact('order','orderItems'));
    }

    //confirmed orders
    public function confirmedOrders(){
        $orders = Order::where('status','Confirmed')->orderBy('id','DESC')->get();
        return view('backend.order.confirmed.index',compact('orders'));
    }

    //processing orders
    public function processingOrders(){
        $orders = Order::where('status','Processing')->orderBy('id','DESC')->get();
        return view('backend.order.processing.index',compact('orders'));
    }

    //picked orders
    public function pickedOrders(){
        $orders = Order::where('status','Picked')->orderBy('id','DESC')->get();
        return view('backend.order.picked.index',compact('orders'));
    }

    //shipped orders
    public function shippedOrders(){
        $orders = Order::where('status','Shipped')->orderBy('id','DESC')->get();
        return view('backend.order.shipped.index',compact('orders'));
    }

    //delivered orders
    public function deliveredOrders(){
        $orders = Order::where('status','Delivered')->orderBy('id','DESC')->get();
        return view('backend.order.delivered.index',compact('orders'));
    }

    //cancel orders
    public function cancelOrders(){
        $orders = Order::where('status','Cancel')->orderBy('id','DESC')->get();
        return view('backend.order.cancel.index',compact('orders'));
    }

    //pending to confirm
    public function pendingConfirm($order_id){
        Order::findOrFail($order_id)->update([
            'status' => 'Confirmed',
            'confirmed_date' => Carbon::now()->format('D, d F Y'),
        ]);
        toast('Order Confirmed!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return Redirect()->route('orders.confirmed');
    }

    //confirm to processing
    public function confirmProcessing($order_id){
        Order::findOrFail($order_id)->update([
            'status' => 'Processing',
            'processing_date' => Carbon::now()->format('D, d F Y'),
        ]);
        toast('Order in Processing!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return Redirect()->route('orders.processing');
    }

    //processing to picked
    public function processingPicked($order_id){
        Order::findOrFail($order_id)->update([
            'status' => 'Picked',
            'picked_date' => Carbon::now()->format('D, d F Y'),
        ]);
        toast('Order Picked!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return Redirect()->route('orders.picked');
    }

    //picked to shipped
    public function pickedShipped(Request $request, $order_id){
        Order::findOrFail($order_id)->update([
            'status' => 'Shipped',
            'shipped_date' => Carbon::now()->format('D, d F Y'),
            'shipping_number' => $request->shipping_number,
        ]);
        toast('Order Shipped!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return Redirect()->route('orders.shipped');
    }

    //shipped to delivered
    public function shippedDelivered($order_id){
        Order::findOrFail($order_id)->update([
            'status' => 'Delivered',
            'delivered_date' => Carbon::now()->format('D, d F Y'),
        ]);
        toast('Order Delivered!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return Redirect()->route('orders.delivered');
    }

    //invoice download admin
    public function orderInvoiceDownload($order_id){
        $order = Order::with('state', 'district', 'pincode', 'user')->where('id',$order_id)->first();
        $orderItems = OrderItem::with('order','product')->where('order_id',$order->id)->orderBy('id','DESC')->get();

        $pdf = Pdf::loadView('backend.order.order_invoice', compact('order','orderItems'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
        // return view('backend.order.order_invoice',compact('order','orderItems'));
    }

    //cancel order reason
    public function cancelOrderReason(Request $request, $order_id){
        $this->validate($request,[
            'cancel_reason' => 'required',
        ]);
        Order::findOrFail($order_id)->update([
            'status' => 'Cancel',
            'cancel_date' => Carbon::now()->format('D, d F Y'),
            'cancel_reason' => $request->cancel_reason,
        ]);
        toast('Order Cancelled!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return Redirect()->route('all.orders');
    }
}
