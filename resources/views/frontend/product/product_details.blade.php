@extends('frontend.layouts.master')
@section('main_title')
    {!! $product->product_name !!} |
@endsection
@section('content')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> <a href="shop-grid-right.html">{{$product->category->name}}</a>
                <span></span> <a href="shop-grid-right.html">{{$product->subcategory->name}}</a>
                <span></span> <a href="shop-grid-right.html">{{$product->subsubcategory->name}}</a>
                <span></span> {!! (Str::limit($product->product_name,25)) !!}
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <div class="product-detail accordion-detail">
                    <div class="row mb-50 mt-30">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                    <figure class="border-radius-10">
                                        <img src="{{asset($product->product_thumbnail)}}" alt="product image" />
                                    </figure>
                                    @foreach ($multiImages as $img)
                                        <figure class="border-radius-10">
                                            <img src="{{asset($img->image)}}" alt="product image" />
                                        </figure>
                                    @endforeach
                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails">
                                    <div><img src="{{asset($product->product_thumbnail)}}" alt="product image" /></div>
                                    @foreach ($multiImages as $img)
                                        <div><img src="{{asset($img->image)}}" alt="product image" /></div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">
                                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-63ceb96ac440e967"></script>
                                <!-- Go to www.addthis.com/dashboard to customize your tools --> 
                                <div class="addthis_inline_share_toolbox"></div>
                                @if ($product->product_qty == 0)
                                    <span class="stock-status out-stock"> Out Of Stock </span>
                                @elseif ($product->discount_price)
                                    @php
                                        $amount = $product->base_price - $product->discount_price;
                                        $discount = ($amount/$product->base_price) * 100;
                                    @endphp
                                    <span class="stock-status out-stock"> -{{round($discount)}}% Sale </span>
                                @endif
                                <h4 class="title-detail text-muted">{{$product->brand->name}}</h4>
                                <h2 class="title-detail" id="pname">{{$product->product_name}}</h2>
                                <div class="product-detail-rating">
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                    </div>
                                </div>
                                <div class="clearfix product-price-cover">
                                    @if ($product->discount_price == null)
                                        <div class="product-price primary-color float-left">
                                            <span class="current-price text-brand">${{$product->selling_price}}</span>
                                            <span>
                                                @php
                                                    $amount = $product->base_price - $product->selling_price;
                                                    $discount = ($amount/$product->base_price) * 100;
                                                @endphp
                                                <span class="save-price font-md color3 ml-15">{{round($discount)}}% Off</span>
                                                <span class="old-price font-md ml-15">${{$product->base_price}}</span>
                                            </span>
                                        </div>
                                    @else
                                        <div class="product-price primary-color float-left">
                                            <span class="current-price text-brand">${{$product->discount_price}}</span>
                                            <span>
                                                @php
                                                    $amount = $product->base_price - $product->discount_price;
                                                    $discount = ($amount/$product->base_price) * 100;
                                                @endphp
                                                <span class="save-price font-md color3 ml-15">{{round($discount)}}% Off</span>
                                                <span class="old-price font-md ml-15">${{$product->base_price}}</span>
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="short-desc mb-30">
                                    <p class="font-lg">{!! $product->short_description !!}</p>
                                </div>
                                @if ($product->product_size)
                                    <div class="attr-detail attr-size mb-30">
                                        <strong class="mr-10">Size: </strong>
                                        {{-- <ul class="list-filter size-filter font-small">
                                            @foreach ($product_size as $size)
                                                <li><a href="#">{{$size}}</a></li>
                                            @endforeach
                                        </ul> --}}
                                        <select class="form-select form-select-solid select-active" data-control="select2" data-placeholder="Select size" id="size" name="size">
                                            @foreach ($product_size as $size)
                                                <option value="{{$size}}">{{$size}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                @if ($product->product_qty == 0)
                                    <div class="detail-extralink mb-50">
                                        <div class="product-extra-link2">
                                            <span class="button button-add-to-cart button-out-of-stock"><i class="fi-rs-shopping-cart"></i>Out Of Stock</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="detail-extralink mb-50">
                                        <div class="detail-qty border radius">
                                            <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                            <span class="qty-val" id="qty">1</span>
                                            <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                        </div>
                                        <input type="hidden" id="product_id" value="{{ $product->id }}" min="1">
                                        <div class="product-extra-link2">
                                            <button type="submit" onclick="addToCart()" class="button button-add-to-cart"><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up" id="{{$product->id}}" onclick="addToWishlist(this.id)"><i class="fi-rs-heart"></i></a>
                                        </div>
                                    </div>
                                @endif
                                <div class="font-xs">
                                    <ul class="mr-50 float-start">
                                        <li class="mb-5">Brand:
                                            <span class="text-brand">
                                                <a href="{{Route('product.brand.details',[$product->brand_id])}}?brand={{$product->brand->slug}}">
                                                    {{$product->brand->name}}
                                                </a>
                                            </span>
                                        </li>
                                        <li class="mb-5">SKU: <span class="text-brand">{{$product->product_sku}}</span></li>
                                    </ul>
                                    <ul class="float-start">
                                        <li class="mb-5">Tags:
                                            @foreach ($product_tags as $tag)
                                                <a href="#" rel="tag">{{$tag}}</a>,
                                            @endforeach
                                        </li>
                                        <li>Stock:
                                            <span class="in-stock text-brand ml-5">
                                                @if ($product->product_qty == 0)
                                                    <span class="text-danger">Out Of Stock</span>
                                                @else
                                                    {{$product->product_qty}} Items In Stock
                                                @endif
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>

                    <div class="product-info">
                        <div class="tab-style3">
                            <ul class="nav nav-tabs text-uppercase">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews (3)</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab entry-main-content">
                                <div class="tab-pane fade show active" id="Description">
                                    <div class="">
                                        <p>{!! $product->long_description !!}</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Reviews">
                                    <!--Comments-->
                                    <div class="comments-area">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h4 class="mb-30">Customer questions & answers</h4>
                                                <div class="comment-list">
                                                    <div class="single-comment justify-content-between d-flex mb-30">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="assets/imgs/blog/author-2.png" alt="" />
                                                                <a href="#" class="font-heading text-brand">Sienna</a>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="d-flex justify-content-between mb-10">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="font-xs text-muted">December 4, 2021 at 3:12 pm </span>
                                                                    </div>
                                                                    <div class="product-rate d-inline-block">
                                                                        <div class="product-rating" style="width: 100%"></div>
                                                                    </div>
                                                                </div>
                                                                <p class="mb-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, suscipit exercitationem accusantium obcaecati quos voluptate nesciunt facilis itaque modi commodi dignissimos sequi repudiandae minus ab deleniti totam officia id incidunt? <a href="#" class="reply">Reply</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-comment justify-content-between d-flex mb-30 ml-30">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="assets/imgs/blog/author-3.png" alt="" />
                                                                <a href="#" class="font-heading text-brand">Brenna</a>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="d-flex justify-content-between mb-10">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="font-xs text-muted">December 4, 2021 at 3:12 pm </span>
                                                                    </div>
                                                                    <div class="product-rate d-inline-block">
                                                                        <div class="product-rating" style="width: 80%"></div>
                                                                    </div>
                                                                </div>
                                                                <p class="mb-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, suscipit exercitationem accusantium obcaecati quos voluptate nesciunt facilis itaque modi commodi dignissimos sequi repudiandae minus ab deleniti totam officia id incidunt? <a href="#" class="reply">Reply</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-comment justify-content-between d-flex">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="assets/imgs/blog/author-4.png" alt="" />
                                                                <a href="#" class="font-heading text-brand">Gemma</a>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="d-flex justify-content-between mb-10">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="font-xs text-muted">December 4, 2021 at 3:12 pm </span>
                                                                    </div>
                                                                    <div class="product-rate d-inline-block">
                                                                        <div class="product-rating" style="width: 80%"></div>
                                                                    </div>
                                                                </div>
                                                                <p class="mb-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, suscipit exercitationem accusantium obcaecati quos voluptate nesciunt facilis itaque modi commodi dignissimos sequi repudiandae minus ab deleniti totam officia id incidunt? <a href="#" class="reply">Reply</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <h4 class="mb-30">Customer reviews</h4>
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width: 90%"></div>
                                                    </div>
                                                    <h6>4.8 out of 5</h6>
                                                </div>
                                                <div class="progress">
                                                    <span>5 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>4 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>3 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>2 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                                                </div>
                                                <div class="progress mb-30">
                                                    <span>1 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                                </div>
                                                <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--comment form-->
                                    <div class="comment-form">
                                        <h4 class="mb-15">Add a review</h4>
                                        <div class="product-rate d-inline-block mb-30"></div>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-12">
                                                <form class="form-contact comment_form" action="#" id="commentForm">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input class="form-control" name="name" id="name" type="text" placeholder="Name" />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input class="form-control" name="email" id="email" type="email" placeholder="Email" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <input class="form-control" name="website" id="website" type="text" placeholder="Website" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="button button-contactForm">Submit Review</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($productFromSameSubSubCategory->count() != 0)
                        <div class="row mt-60">
                            <div class="col-12">
                                <h2 class="section-title style-1 mb-30">Related products</h2>
                            </div>
                            <div class="col-12">
                                <div class="row related-products">
                                    <div class="carausel-4-columns-cover arrow-center position-relative">
                                        <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                                        <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                                            @forelse ($productFromSameSubSubCategory as $product)
                                                <div class="product-cart-wrap">
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
                                                        @if ($product->discount_price)
                                                            @php
                                                                $amount = $product->base_price - $product->discount_price;
                                                                $discount = ($amount/$product->base_price)*100;
                                                            @endphp
                                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                                <span class="hot">Save {{round($discount)}}%</span>
                                                            </div>
                                                        @else
                                                            @php
                                                                $amount = $product->base_price - $product->selling_price;
                                                                $discount = ($amount/$product->base_price)*100;
                                                            @endphp
                                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                                <span class="hot">Save {{round($discount)}}%</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="product-content-wrap">
                                                        <div class="product-brand">
                                                            <a href="{{Route('product.brand.details',[$product->brand_id])}}?brand={{$product->brand->slug}}">
                                                                {{$product->brand->name}}
                                                            </a>
                                                        </div>
                                                        <div class="product-category mb-0">
                                                            <a href="{{Route('product.subsubcategory.details',[$product->subsubcategory_id])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}">
                                                                {{$product->subsubcategory->name}}
                                                            </a>
                                                        </div>
                                                        <h2 id="product-title-h2">
                                                            <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
                                                                {!! Str::limit($product->product_name,25) !!}
                                                            </a>
                                                        </h2>
                                                        <div class="product-rate d-inline-block">
                                                            <div class="product-rating" style="width: 80%"></div>
                                                        </div>
                                                        <div class="product-price mt-10">
                                                            @if ($product->discount_price)
                                                                <span>${{$product->discount_price}} </span>
                                                            @else
                                                                <span>${{$product->selling_price}} </span>
                                                            @endif
                                                            <span class="old-price">${{$product->base_price}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--End product Wrap-->
                                            @empty
                                            @endforelse
                                        </div>
                                    </div>
                                    <!--End Col-lg-9-->
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($productFromSameCategory->count() != 0)
                        <div class="row mt-60">
                            <div class="col-12">
                                <h2 class="section-title style-1 mb-30">Customer Also Like</h2>
                            </div>
                            <div class="col-12">
                                <div class="row related-products">
                                    <div class="carausel-4-columns-cover arrow-center position-relative">
                                        <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-2-arrows"></div>
                                        <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns-2">
                                            @forelse ($productFromSameCategory as $product)
                                                <div class="product-cart-wrap">
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
                                                        @if ($product->discount_price)
                                                            @php
                                                                $amount = $product->base_price - $product->discount_price;
                                                                $discount = ($amount/$product->base_price)*100;
                                                            @endphp
                                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                                <span class="hot">Save {{round($discount)}}%</span>
                                                            </div>
                                                        @else
                                                            @php
                                                                $amount = $product->base_price - $product->selling_price;
                                                                $discount = ($amount/$product->base_price)*100;
                                                            @endphp
                                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                                <span class="hot">Save {{round($discount)}}%</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="product-content-wrap">
                                                        <div class="product-brand">
                                                            <a href="{{Route('product.brand.details',[$product->brand_id])}}?brand={{$product->brand->slug}}">
                                                                {{$product->brand->name}}
                                                            </a>
                                                        </div>
                                                        <div class="product-category mb-0">
                                                            <a href="{{Route('product.subsubcategory.details',[$product->subsubcategory_id])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}">
                                                                {{$product->subsubcategory->name}}
                                                            </a>
                                                        </div>
                                                        <h2 id="product-title-h2">
                                                            <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
                                                                {!! Str::limit($product->product_name,25) !!}
                                                            </a>
                                                        </h2>
                                                        <div class="product-rate d-inline-block">
                                                            <div class="product-rating" style="width: 80%"></div>
                                                        </div>
                                                        <div class="product-price mt-10">
                                                            @if ($product->discount_price)
                                                                <span>${{$product->discount_price}} </span>
                                                            @else
                                                                <span>${{$product->selling_price}} </span>
                                                            @endif
                                                            <span class="old-price">${{$product->base_price}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--End product Wrap-->
                                            @empty
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
<style>
    .button-out-of-stock{
        font-size: 16px;
        font-weight: 500;
        padding: 15px 40px;
        color: #ffffff;
        border: none;
        background-color: #b73b3b;
        border: 1px solid #a52929;
        border-radius: 10px;
    }

    .button-out-of-stock:hover{
        background-color: #a52929 !important;
    }
</style>
@endsection
