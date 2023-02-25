@extends('frontend.layouts.master')
@section('content')
    <main class="main">
        <div class="container mb-30">
            <div class="row">
                <div class="col-12">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p>We found <strong class="text-brand">{{App\Models\Wishlist::where('user_id',Auth::id())->count()}}</strong> items for you!</p>
                        </div>
                    </div>
                    <div class="row product-grid" id="wishlist">

                        <!--end product card-->
                    </div>
                    <!--product grid-->
                </div>
            </div>
        </div>
    </main>
@endsection
