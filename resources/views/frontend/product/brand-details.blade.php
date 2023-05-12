@extends('frontend.layouts.master')
@section('main_title')
    {!! $brand->name !!} |
@endsection
@php
    use App\Models\WebsiteSetting;

    $website = WebsiteSetting::findOrFail(1);
@endphp
@section('content')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> {{$brand->name}}
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row">
            <div class="col-12">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand">{{$products->total()}}</strong> items for you!</p>
                    </div>
                    <div class="sort-by-product-area">
                        <div class="sort-by-cover mr-10">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps"></i>Show:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">50</a></li>
                                    <li><a href="#">100</a></li>
                                    <li><a href="#">150</a></li>
                                    <li><a href="#">200</a></li>
                                    <li><a href="#">All</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sort-by-cover">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">Featured</a></li>
                                    <li><a href="#">Price: Low to High</a></li>
                                    <li><a href="#">Price: High to Low</a></li>
                                    <li><a href="#">Release Date</a></li>
                                    <li><a href="#">Avg. Rating</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row product-grid">
                    @forelse ($products as $key=>$product)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 @if ($key++>=17)d-none d-xl-block @endif">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="shop-product-right.html">
                                            <img class="default-img" src="{{asset($product->product_thumbnail)}}" alt="" />
                                            <img class="hover-img" src="{{asset($product->product_thumbnail)}}" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-action-1 d-flex flex-row">
                                        <a aria-label="Add To Wishlist" class="action-btn" id="{{$product->id}}" onclick="addToWishlist(this.id)"><i class="fi-rs-heart"></i></a>
                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$product->id}}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                    </div>
                                    @if ($product->product_qty == 0)
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="hot">
                                                    Out Of Stock
                                                </span>
                                            </div>
                                        @else
                                            @if ($product->discount_price)
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="best">
                                                        @php
                                                            $amount = $product->base_price - $product->discount_price;
                                                            $discount = ($amount/$product->base_price) * 100;
                                                        @endphp
                                                        -{{round($discount)}}%
                                                    </span>
                                                </div>
                                            @elseif ($product->hot_deal)
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">
                                                        Hot
                                                    </span>
                                                </div>
                                            @elseif ($product->special_deal)
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="sale">
                                                        Sale
                                                    </span>
                                                </div>
                                            @endif
                                        @endif
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-brand">
                                        <a href="{{Route('product.brand.details',[$product->brand_id])}}?brand={{$product->brand->slug}}">{{$product->brand->name}}</a>
                                    </div>
                                    <div class="product-category mb-0">
                                        <a href="{{Route('product.subsubcategory.details',[$product->subsubcategory_id])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}">
                                            {{$product->subsubcategory->name}}
                                        </a>
                                    </div>
                                    <h2 id="product-title-h2">
                                        <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
                                            {!! Str::limit($product->product_name,22) !!}
                                        </a>
                                    </h2>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    <div>
                                        <span class="font-small text-muted">By <a href="/">{{$website->company_name}}</a></span>
                                    </div>
                                    <div class="product-card-bottom">
                                        <div class="product-price">
                                            @if ($product->discount_price)
                                                <span>${{$product->discount_price}} </span>
                                            @else
                                                <span>${{$product->selling_price}} </span>
                                            @endif
                                            <span class="old-price">${{$product->base_price}}</span>
                                        </div>
                                        @if ($product->product_qty == 0)
                                            <div class="out-of-stock">
                                                <span class="add">Sold Out</span>
                                            </div>
                                        @else
                                            <div class="add-cart">
                                                <a class="add" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$product->id}}" onclick="productView(this.id)"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h4 class="text-danger">No Product Found!!</h4>
                    @endforelse
                    <!--end product card-->
                </div>
                <!--product grid-->
                <div class="pagination-area mt-20 mb-20">
                    <nav aria-label="Page navigation example">
                        {{$products->links()}}
                    </nav>
                </div>
                @if ($hot_deals->count() != 0)
                    @include('frontend.extra.hot_deals')
                @endif
                <!--End Deals-->
            </div>
        </div>
    </div>
</main>
@endsection
