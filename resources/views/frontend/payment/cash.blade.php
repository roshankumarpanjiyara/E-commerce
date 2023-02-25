@extends('frontend.layouts.master')
@section('main_title')
    Cash Payment |
@endsection
@section('content')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Shop
                <span></span> Checkout
                <span></span> Cash On Delivery
            </div>
        </div>
    </div>
    <div class="container rounded bg-white mb-80 mt-20">
        <div class="row d-flex justify-content-center pb-5">
            <div class="col-sm-3 col-md-4 md-1">
                <div class="py-4 d-flex flex-row">
                    <h5><b>Cash On Delivery</b> | </h5><span class="p-1"></span><span class="pl-2"> Payment</span>
                </div>
                @if (Session::has('coupon'))
                    <div class="bg-light rounded d-flex flex-column">
                        <div class="p-2 ml-3"><h4>Order Recap</h4></div>
                        <div class="p-2 d-flex">
                            <div class="col-8">SubTotal</div>
                            <div class="ml-auto">${{$cartSubTotal}}</div>
                        </div>
                        <div class="p-2 d-flex">
                            <div class="col-8">Tax</div>
                            <div class="ml-auto">+ ${{$cartTax}}</div>
                        </div>
                        <div class="p-2 d-flex">
                            <div class="col-8">Total</div>
                            <div class="ml-auto"><strong>${{$cartTotal}}</strong></div>
                        </div>
                        <div class="border-top px-4 mx-3">
                        </div>
                        <div class="p-2 d-flex pt-3">
                            <div class="col-8">Coupon</div>
                            <div class="ml-auto">{{session()->get('coupon')['coupon_name']}} - <strong class="green">{{session()->get('coupon')['discount']}}%</strong></div>
                        </div>
                        <div class="p-2 d-flex">
                            <div class="col-8">Discount</div>
                            <div class="ml-auto">- ${{session()->get('coupon')['discount_amount']}}</div>
                        </div>
                        <div class="border-top px-4 mx-3"></div>
                        <div class="p-2 d-flex pt-3">
                            <div class="col-8"><strong>Grand Total</strong></div>
                            <div class="ml-auto"><strong class="green">${{session()->get('coupon')['total_amount']}}</strong></div>
                        </div>
                    </div>
                @else
                    <div class="bg-light rounded d-flex flex-column">
                        <div class="p-2 ml-3"><h4>Order Recap</h4></div>
                        <div class="p-2 d-flex">
                            <div class="col-8">SubTotal</div>
                            <div class="ml-auto">${{$cartSubTotal}}</div>
                        </div>
                        <div class="p-2 d-flex">
                            <div class="col-8">Tax</div>
                            <div class="ml-auto">+ ${{$cartTax}}</div>
                        </div>
                        <div class="border-top px-4 mx-3">
                        </div>
                        <div class="p-2 d-flex pt-3">
                            <div class="col-8"><strong>Total</strong></div>
                            <div class="ml-auto"><strong class="green">${{$cartTotal}}</strong></div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-sm-5 col-md-5 offset-md-1 mobile">
                <div class="py-4 d-flex justify-content-end">
                    <h6><a href="/">Cancel and return to website</a></h6>
                </div>
                @if (Session::has('coupon'))
                    <h4 class="green">Total Payment: ${{session()->get('coupon')['total_amount']}}</h4>
                @else
                    <h4 class="green">Total Payment: ${{$cartTotal}}</h4>
                @endif
                <hr>
                <h4>Complete Payment</h4>
                <div class="pt-2">
                    <form class="pb-3" action="{{route('cash.order')}}" method="post" id="payment-form">@csrf
                        <div class="form-row">
                            <label for="card-element">
                                <input type="hidden" name="name" value="{{$data['shipping_name']}}">
                                <input type="hidden" name="email" value="{{$data['shipping_email']}}">
                                <input type="hidden" name="phone" value="{{$data['shipping_phone']}}">
                                <input type="hidden" name="address" value="{{$data['shipping_address']}}">
                                <input type="hidden" name="notes" value="{{$data['notes']}}">
                                <input type="hidden" name="state_id" value="{{$data['state_id']}}">
                                <input type="hidden" name="district_id" value="{{$data['district_id']}}">
                                <input type="hidden" name="pincode_id" value="{{$data['pincode_id']}}">
                            </label>
                        </div>
                        <br>
                        <button class="btn btn-primary btn-block">Proceed to payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection