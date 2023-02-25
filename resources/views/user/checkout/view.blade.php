@extends('frontend.layouts.master')
@section('main_title')
    Checkout |
@endsection
@section('content')
<script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Shop
                <span></span> Checkout
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-25">
        <div class="row">
            <div class="col-lg-8 mb-20">
                <h1 class="heading-2 mb-10">Checkout</h1>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">There are <span class="text-brand">{{$cartQty}}</span> products in your cart</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <div class="row mb-50">
                    @if (Session::has('coupon'))
                        
                    @else
                        <div class="col-lg-6" id="couponField">
                            <div class="apply-coupon">
                                <input type="text" placeholder="Enter Coupon Code..." id="coupon_name" autocomplete="off">
                                <button class="btn btn-md" onclick="applyCoupon()">Apply Coupon</button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <form action="{{route('checkout.store')}}" method="post">@csrf
            <div class="row">
                <div class="col-lg-7">
                    <div class="row">
                        <h4 class="mb-30">Shipping Address</h4>
                            <div>
                                <div class="row">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-solid @error('shipping_name') is-invalid @enderror" required="" name="shipping_name" placeholder="Name *" value="{{Auth::user()->name}}" autocomplete="off">
                                        @error('shipping_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-solid @error('shipping_address') is-invalid @enderror" name="shipping_address" required="" placeholder="Address *" autocomplete="off">
                                        @error('shipping_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="shipping_address_2" placeholder="Address line 2" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row shipping_calculator">
                                    <div class="form-group col-lg-6">
                                        <div class="custom_select">
                                            <select class="form-control select-active @error('state_id') is-invalid @enderror" required name="state_id" data-control="select2" data-placeholder="Select State *" data-allow-clear="true">
                                                <option value=""></option>
                                                @foreach($states as $state)
                                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('state_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="custom_select">
                                            <select class="form-control select-active @error('district_id') is-invalid @enderror" required name="district_id" data-control="select2" data-placeholder="Select City/Town *" data-allow-clear="true">
                                                
                                            </select>
                                        </div>
                                        @error('district_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row shipping_calculator">
                                    <div class="form-group col-lg-6">
                                        <div class="custom_select">
                                            <select class="form-control select-active @error('pincode_id') is-invalid @enderror" required name="pincode_id" data-control="select2" data-placeholder="Select Postal Code *" data-allow-clear="true">
                                                
                                            </select>
                                        </div>
                                        @error('pincode_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <input class="form-control form-control-solid @error('shipping_phone') is-invalid @enderror" required="" type="number" name="shipping_phone" placeholder="Phone *" autocomplete="off" value="{{Auth::user()->phone}}">
                                        @error('shipping_phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <input class="form-control form-control-solid @error('shipping_email') is-invalid @enderror" required="" type="email" name="shipping_email" placeholder="Email address *" autocomplete="off" value="{{Auth::user()->email}}">
                                        @error('shipping_email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-30">
                                    <textarea rows="5" cols="30" name="notes" placeholder="Additional information"></textarea>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="border p-40 cart-totals ml-30 mb-50">
                        <div class="d-flex align-items-end justify-content-between mb-15">
                            <h4>Your Order</h4>
                            <h6 class="text-muted">Subtotal</h6>
                        </div>
                        <div class="divider-2 mb-20"></div>
                        <div class="table-responsive order_table checkout">
                            <table class="table no-border">
                                <tbody>
                                    @forelse ($carts as $product)
                                        <tr>
                                            <td class="image product-thumbnail"><img src="{{asset($product->options->image)}}" alt="#"></td>
                                            <td>
                                                <h6 class="w-160 mb-5"><a href="/product/{{$product->options->sku}}/{{$product->id}}/{{$product->options->slug}}" target="_blank" class="text-heading">{!! Str::limit($product->name,25) !!}</a></h6>
                                                <div class="product-rate-cover">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width:90%">
                                                        </div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                                </div>
                                                <div class="product-rate-cover">
                                                    <span class="font-small ml-5 text-muted">Size: {{$product->options->size}}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <h6 class="text-muted pl-20 pr-20">x {{$product->qty}}</h6>
                                            </td>
                                            <td>
                                                <h4 class="text-brand">${{$product->price * $product->qty}}</h4>
                                            </td>
                                        </tr>
                                    @empty
                                        
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="divider-2 mb-20"></div>
                        <div id="couponCalCheckout">
                            {{-- @if (Session::has('coupon'))
                                <div class="d-flex align-items-end justify-content-between mb-5">
                                    <h6>Total</h6>
                                    <h6 class="text-brand">${{$cartTotal}}</h6>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mb-5">
                                    <h6>Coupon Discount</h6>
                                    <h6 class="text-muted">{{session()->get('coupon')['coupon_name']}} - {{session()->get('coupon')['discount']}}% <a type="submit" class="text-end" onclick="couponRemove()"><i class="fi-rs-trash"></i></a></h6>
                                </div>
                                <div class="divider-2 mb-20"></div>
                                <div class="d-flex align-items-end justify-content-between mb-10">
                                    <h4>Grand Total</h4>
                                    <h4 class="text-brand">${{session()->get('coupon')['total_amount']}}</h4>
                                </div>
                            @else
                                <div class="d-flex align-items-end justify-content-between mb-10">
                                    <h4>Total</h4>
                                    <h4 class="text-brand">${{$cartTotal}}</h4>
                                </div>
                            @endif --}}
                        </div>
                    </div>
                    <div class="payment ml-30">
                        <h4 class="mb-30">Payment</h4>
                        <div class="payment_option">
                            <div class="custome-radio">
                                <input class="form-check-input" value="card" type="radio" name="payment_method" id="card">
                                <label class="form-check-label" for="card" data-bs-toggle="collapse" data-target="#card" aria-controls="card">Card</label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" value="cash" type="radio" name="payment_method" id="cash">
                                <label class="form-check-label" for="cash" data-bs-toggle="collapse" data-target="#cash" aria-controls="cash">Cash On Delivery</label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" value="stripe" type="radio" name="payment_method" id="stripe">
                                <label class="form-check-label" for="stripe" data-bs-toggle="collapse" data-target="#stripe" aria-controls="stripe">Stripe</label>
                            </div>
                        </div>
                        <div class="payment-logo d-flex">
                            <img class="mr-15" src="{{asset("frontend/assets/imgs/theme/icons/payment-paypal.svg")}}" alt="">
                            <img class="mr-15" src="{{asset("frontend/assets/imgs/theme/icons/payment-visa.svg")}}" alt="">
                            <img class="mr-15" src="{{asset("frontend/assets/imgs/theme/icons/payment-master.svg")}}" alt="">
                            <img src="{{asset("frontend/assets/imgs/theme/icons/payment-zapper.svg")}}" alt="">
                        </div>
                        <button type="submit" class="btn btn-fill-out btn-block mt-30">Place an Order<i class="fi-rs-sign-out ml-15"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="state_id"]').on('change', function(){
            var state_id = $(this).val();
            if(state_id) {
                $.ajax({
                    url: "{{  url('/checkout/district/ajax') }}/"+state_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        $('select[name="pincode_id"]').html('');
                        var d = $('select[name="district_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="district_id"]').append('<option></option><option value="'+ value.id +'">' + value.name + '</option>');
                            });
                    },
                });
            } else {
                alert('danger');
            }
        });

        $('select[name="district_id"]').on('change', function(){
            var district_id = $(this).val();
            if(district_id) {
                $.ajax({
                    url: "{{  url('/checkout/pincode/ajax') }}/"+district_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                    var d =$('select[name="pincode_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="pincode_id"]').append('<option></option><option value="'+ value.id +'">' + value.pincode + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });

    });
</script>
@endsection