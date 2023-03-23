@extends('frontend.layouts.master')
@section('main_title')
    Order Details |
@endsection
@section('content')
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Shop
                <span></span> Order
                <span></span> View
            </div>
        </div>
    </div>
    <div class="container mb-30 mt-30">
        <div class="row">
            <div class="col-lg-8 mb-20">
                <h1 class="heading-2 mb-10">Your Order Details  <span class="fs-5">#{{$order->order_number}}</span></h1>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">There are <span class="text-brand">{{$orderItems->count()}}</span> products in your cart</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                            <tr class="main-heading">
                                <th scope="col" colspan="2" class="start pl-10">Product</th>
                                <th scope="col">Size</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col" class="end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderItems as $item)
                                <tr>
                                    <td class="image product-thumbnail pt-20"><img src="{{asset($item->product->product_thumbnail)}}" alt="#" style="max-width:80px;"></td>
                                    <td class="product-des product-name">
                                        <span class="text-muted">{{$item->product->brand->name}}</span>
                                        <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="{{Route('product.details',[$item->product->product_sku,$item->product->id,$item->product->product_slug])}}?category={{$item->product->category->slug}}&subcategory={{$item->product->subcategory->slug}}&subsubcategory={{$item->product->subsubcategory->slug}}" target="_blank">{!! Str::limit($item->product->product_name, 30, '...') !!}</a></h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:90%">
                                                </div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Size">
                                        <p class="text-body">{{$item->size}}</p>
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h4 class="text-body fs-6">${{$item->price}} </h4>
                                    </td>
                                    <td class="text-center detail-info" data-title="Stock">
                                        <div class="detail-extralink mr-15">
                                            <h4 class="text-body fs-6">{{$item->qty}} </h4>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h4 class="text-brand fs-4">${{$item->qty*$item->price}} </h4>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="divider-2 mb-20"></div>
                @if ($order->status !== 'Delivered' && $order->return_reason == NULL && $order->status !== 'Cancel')
                    <div class="cart-action d-flex justify-content-end">
                        <a href="{{route('cancel.order',[$order->id])}}" class="btn mr-10 mb-sm-15" style="background-color: rgba(223, 3, 3, 0.823)" id="cancel"><i class="fi-rs-cross mr-10"></i>Cancel</a>
                    </div>
                @endif
                @if ($order->status === "Delivered")
                    @if ($order->return_reason == NULL)
                        <div class="row mt-30">
                            <div class="col-lg-12">
                                <div class="calculate-shiping p-20 border-radius-15 border">
                                    <h4 class="mb-10">Order Return Reason</h4>
                                    <form class="field_form shipping_calculator" action="{{route('order.return.reason',[$order->id])}}" method="POST">@csrf
                                        <div class="form-row">
                                            <div class="form-group col-lg-12">
                                                <textarea id="" cols="30" rows="05" placeholder="Return Reason" name="return_reason" required></textarea>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn mb-20">Return Request</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row mt-30">
                            <div class="col-lg-12">
                                <div class="calculate-shiping p-20 border-radius-15 border">
                                    <h4 class="mb-10">Order Return Reason</h4>
                                    <span class="stock-status text-danger mb-0"> You have send return request for this order!! </span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                @if ($order->status === 'Cancel' && $order->cancel_reason != NULL)
                    <div class="row mt-30">
                        <div class="col-lg-12">
                            <div class="calculate-shiping p-20 border-radius-15 border">
                                <h4 class="mb-10">Order Cancel Reason</h4>
                                <span class="stock-status text-danger mb-0"> {{$order->cancel_reason}} </span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="border p-md-4 cart-totals ml-30">
                    <div class="table-responsive">
                        <table class="table no-border">
                            <thead>
                                <tr class="main-heading">
                                    <th scope="col" colspan="2" class="start pl-10">Billing Address</th>
                                </tr>
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Invoice No.</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-heading text-end fs-6" style="color: rgba(223, 3, 3, 0.823)">{{$order->invoice_no}}</h4>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Name</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-heading text-end fs-6">{{$order->name}}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Email</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-heading text-end fs-6">{{$order->email}}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Phone</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-heading text-end fs-6">{{$order->phone}}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="col" colspan="2">
                                        <div class="divider-2 mt-10 mb-10"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Address</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h5 class="text-heading text-end fs-6">{!!$order->address!!}</h4>
                                    </td> 
                                </tr> 
                                <tr>
                                    <td></td>
                                    <td class="cart_total_amount">
                                        <h5 class="text-heading text-end fs-6">{{$order->district->name}} - {{$order->pincode->pincode}}, {{$order->state->name}}</h4>
                                    </td> 
                                </tr> 
                                <tr>
                                    <td scope="col" colspan="2">
                                        <div class="divider-2 mt-10 mb-10"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Order Date</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h5 class="text-heading text-end fs-6">{{$order->order_date}}</h5>
                                    </td>
                                </tr>
                                @if ($order->status === 'Delivered')
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Delivery Date</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h5 class="text-heading text-success text-end fs-6">{{$order->delivered_date}}</h5>
                                        </td>
                                    </tr>
                                @endif
                                @if ($order->status === 'Cancel')
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Cancel Date</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h5 class="text-heading text-danger text-end fs-6">{{$order->cancel_date}}</h5>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Payment</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h5 class="text-heading text-end fs-6">{{$order->payment_type}}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Total</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">${{$order->amount}}</h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button class="btn mb-20 w-100 fs-5">{{$order->status}}</button>
                </div>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript">
      //cancel
  $(function(){
    $(document).on('click','#cancel',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


                  Swal.fire({
                    title: 'Are you sure to Cancel?',
                    text: "Once cancelled, You will not be able to proceed back!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Cancel!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Cancelled!',
                        'Order Cancelled!',
                        'success'
                      )
                    }
                  })


    });

  });
</script>
@endsection
