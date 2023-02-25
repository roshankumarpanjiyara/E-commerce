@extends('frontend.layouts.master')
@section('main_title')
    Stripe Payment |
@endsection
@section('content')
<style>
    /**
    * The CSS shown here will not be introduced in the Quickstart guide, but shows
    * how you can use CSS to style your Element's container.
    */
    .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }
    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }
    .StripeElement--invalid {
        border-color: #fa755a;
    }
    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>
<style>
    .green{
        color: rgb(15, 207, 143);
        font-weight: 680;
    }

    @media(max-width:567px){
        .mobile{
            padding-top: 40px;
        }
    }
</style>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Shop
                <span></span> Checkout
                <span></span> Stripe
            </div>
        </div>
    </div>
    <div class="container rounded bg-white mb-80 mt-20">
        <div class="row d-flex justify-content-center pb-5">
            <div class="col-sm-3 col-md-4 md-1">
                <div class="py-4 d-flex flex-row">
                    <h5><b>Stripe</b> | </h5><span class="p-1"></span><span class="pl-2"> Payment</span>
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
                    <form class="pb-3" action="{{route('stripe.order')}}" method="post" id="payment-form">@csrf
                        <div class="form-row">
                            <label for="card-element">
                                <strong>Credit or debit card</strong>
                                <input type="hidden" name="name" value="{{$data['shipping_name']}}">
                                <input type="hidden" name="email" value="{{$data['shipping_email']}}">
                                <input type="hidden" name="phone" value="{{$data['shipping_phone']}}">
                                <input type="hidden" name="address" value="{{$data['shipping_address']}}">
                                <input type="hidden" name="notes" value="{{$data['notes']}}">
                                <input type="hidden" name="state_id" value="{{$data['state_id']}}">
                                <input type="hidden" name="district_id" value="{{$data['district_id']}}">
                                <input type="hidden" name="pincode_id" value="{{$data['pincode_id']}}">
                            </label>
                            
                            <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                            </div>
                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <br>
                        <button class="btn btn-primary btn-block">Proceed to payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript">
    // Create a Stripe client.
    var stripe = Stripe('pk_test_51IAvrrJOAl9GMXiBUUhm68QufY01Dv2u780V0vb0PHdYYHxrBUX4WnR9WBWWtwEFaFAwtdsJrXkiSNYunrCdBh2j006J3RUEiw');
    // Create an instance of Elements.
    var elements = stripe.elements();
    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
    base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
        color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
    };
    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});
    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');
    // Handle real-time validation errors from the card Element.
    card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        stripe.createToken(card).then(function(result) {
            if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
            } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
            }
        });
    });
    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        // Submit the form
        form.submit();
    }
</script>
@endsection