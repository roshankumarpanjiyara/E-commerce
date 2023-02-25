@extends('frontend.layouts.master')
@section('main_title')
    My Cancel Orders |
@endsection
@section('content')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Shop <span></span>Cancel Orders
            </div>
        </div>
    </div>
    <div class="container mb-30 mt-30">
        <div class="row">
            <div class="col-xl-12 col-lg-12 m-auto">
                <div class="mb-30">
                    <h1 class="heading-2 mb-10">My Orders</h1>
                    <h6 class="text-body">There are <span class="text-brand">{{$orders->count()}}</span> products in this list</h6>
                </div>
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                            <tr class="main-heading">
                                <th scope="col" class="start pl-20">Order Id</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Cancel Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">View</th>
                                <th scope="col" class="end">Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr class="pt-30">
                                    <td class="product-des product-name pl-20">
                                        <h6>Order Id: <a class="product-name mb-10" href="shop-product-right.html">{{$order->order_number}}</a></h6>
                                        <div class="product-rate-cover">
                                            <div class="d-inline-block">
                                                Invoice No.: <span>{{$order->invoice_no}}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right" data-title="Cart">
                                        <span>{{$order->payment_type}}</span>
                                    </td>
                                    <td class="text-right" data-title="Cart">
                                        <span>{{$order->cancel_date}}</span>
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h4 class="text-brand">${{$order->amount}}</h4>
                                    </td>
                                    <td class="text-right detail-info" data-title="Stock">
                                        <span class="stock-status text-danger mb-0"> {{$order->status}} </span>
                                    </td>
                                    <td class="text-right" data-title="Cart">
                                        <a href="{{route("order.view",[$order->id,$order->order_number])}}" class="btn btn-sm" style="background-color: #0095e8"><i class="fa-solid fa-eye"></i> View</a>
                                    </td>
                                    @if ($order->status !== 'Pending' && $order->status !== 'Cancel')
                                        <td class="action text-right" data-title="Cart">
                                            <a href="{{route("invoice.download",[$order->id,$order->order_number])}}" target="_blank" class="btn btn-sm" style="background-color: #d9214e"><i class="fa-solid fa-file-arrow-down"></i> Invoice</a>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                
                            @endforelse
                        </tbody>
                        <div class="pagination-area mt-20 mb-20">
                            <nav aria-label="Page navigation example">
                                {{$orders->links()}}
                            </nav>
                        </div>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
