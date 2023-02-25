
<main class="main">
    <section class="home-slider position-relative mb-30">
        <div class="container">
            <div class="home-slide-cover mt-30">
                <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                    @foreach ($sliders as $slider)
                        <div class="single-hero-slider single-animation-wrap" style="background-image: url({{asset($slider->slider_img)}})">
                            <div class="slider-content">
                                <h1 class="display-2 mb-40">
                                    {!! $slider->title !!}
                                </h1>
                                <p class="mb-65">{!! $slider->description !!}</p>
                                @if ($slider->link != NULL)
                                    <a href="{{$slider->link}}" class="btn" tabindex="-1">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                                @endif
                            </div>
                            <div class="slider-content">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="slider-arrow hero-slider-1-arrow"></div>
            </div>
        </div>
    </section>
    <!--End hero slider-->
    <section class="popular-categories section-padding">
        <div class="container wow animate__animated animate__fadeIn">
            <div class="section-title">
                <div class="title">
                    <h3>Featured Brands</h3>
                </div>
                <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow" id="carausel-10-columns-arrows"></div>
            </div>
            <div class="carausel-10-columns-cover position-relative">
                <div class="carausel-10-columns" id="carausel-10-columns">
                    @foreach ($brands as $key=>$brand)
                        <div class="card-2 bg-{{$key++}} wow animate__animated animate__fadeInUp" style="padding: 15px 0px 12px 0px; min-height: 100px;" data-wow-delay=".{{$key++}}s">
                            <figure class="img-hover-scale overflow-hidden">
                                <a href="{{Route('product.brand.details',[$brand->id])}}?brand={{$brand->slug}}">
                                    <img style="width: 60px; height: 50px;" src="{{asset($brand->image)}}" alt="" />
                                </a>
                            </figure>
                            <h6><a href="{{Route('product.brand.details',[$brand->id])}}?brand={{$brand->slug}}">{{$brand->name}}</a></h6>
                            <span>{{App\Models\Product::where('brand_id',$brand->id)->count()}}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--End category slider-->
    <section class="banners mb-25">
        <div class="container">
            @php
                $banners = App\Models\Banner::where('type',2)->where('status',1)->limit(3)->latest()->get();
            @endphp
            <div class="row">
                @foreach ($banners as $key=>$banner)
                    @if (!$loop->last)
                        <div class="col-lg-4 col-md-6">
                            <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay=".{{$key+2}}s">
                                <img src="{{asset($banner->banner_img)}}" alt="" />
                                <div class="banner-text">
                                    <h4>
                                        {!! $banner->title !!}
                                    </h4>
                                    <p>{!! $banner->description !!}</p>
                                    @if ($banner->link != null)
                                        <a href="{{$banner->link}}" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-4 d-md-none d-lg-flex">
                            <div class="banner-img mb-sm-0 wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                                <img src="{{asset($banner->banner_img)}}" alt="" />
                                <div class="banner-text">
                                    <h4>
                                        {!! $banner->title !!}
                                    </h4>
                                    <p>{!! $banner->description !!}</p>
                                    @if ($banner->link != null)
                                        <a href="{{$banner->link}}" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!--End banners-->
    <section class="product-tabs section-padding position-relative">
        <div class="container">
            <div class="section-title style-2 wow animate__animated animate__fadeIn">
                <h3>Popular Products</h3>
                <ul class="nav nav-tabs links" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">All</button>
                    </li>
                    @foreach ($categories as $category)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-{{$category->slug}}" data-bs-toggle="tab" data-bs-target="#tab-{{$category->slug}}" type="button" role="tab" aria-controls="tab-{{$category->slug}}" aria-selected="false">
                                {{$category->name}}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!--End nav-tabs-->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                    <div class="row product-grid-4">
                        @forelse ($products as $key=>$product)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 @if($key === 9)d-none d-xl-block @endif">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".{{$key++}}s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
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
                                                {!! Str::limit($product->product_name,25) !!}
                                            </a>
                                        </h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
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
                            <!--end product card-->
                        @empty
                            <h4 class="text-danger">No Product Found!!</h4>
                        @endforelse
                    </div>
                    <!--End product-grid-4-->
                </div>
                <!--En tab one-->
                @foreach ($categories as $category)
                    @php
                        $category_wise_product = App\Models\Product::where('category_id',$category->id)->orderBy('id','DESC')->get();
                    @endphp
                    <div class="tab-pane fade" id="tab-{{$category->slug}}" role="tabpanel" aria-labelledby="tab-{{$category->slug}}">
                        <div class="row product-grid-4">
                            @forelse ($category_wise_product as $key=>$product)
                                @php
                                    $product_view = App\Models\Product::where('product_slug',$product->product_slug)->first();
                                    $product_quick_view = App\Models\Product::findOrFail($product_view->id);
                                @endphp
                                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 @if($key == 9)d-none d-xl-block @endif">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
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
                                                    {!! Str::limit($product->product_name,25) !!}
                                                </a>
                                            </h2>
                                            <div class="product-rate-cover">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                                            </div>
                                            <div>
                                                <span class="font-small text-muted">By <a href="vendor-details-1.html">NestFood</a></span>
                                            </div>
                                            <div class="product-card-bottom">
                                                <div class="product-price" style="font-size:10px">
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
                                <!--end product card-->
                            @empty
                                <h4 class="text-danger">No Product Found!!</h4>
                            @endforelse
                        </div>
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab two-->
                @endforeach
            </div>
            <!--End tab-content-->
        </div>
    </section>
    <!--Products Tabs-->
    <section class="section-padding pb-5">
        <div class="container">
            <div class="section-title wow animate__animated animate__fadeIn">
                <h3 class="">Daily Best Sells</h3>
                <ul class="nav nav-tabs links" id="myTab-2" role="tablist">
                    @if ($featureds->count() != 0)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-tab-one-1" data-bs-toggle="tab" data-bs-target="#tab-one-1" type="button" role="tab" aria-controls="tab-one" aria-selected="true">Featured</button>
                        </li>
                    @endif
                    @if ($special_deals->count() != 0)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-two-1" data-bs-toggle="tab" data-bs-target="#tab-two-1" type="button" role="tab" aria-controls="tab-two" aria-selected="false">Special Deals</button>
                        </li>
                    @endif
                    @if ($special_offers->count() != 0)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-three-1" data-bs-toggle="tab" data-bs-target="#tab-three-1" type="button" role="tab" aria-controls="tab-three" aria-selected="false">Special Offers</button>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="row">
                @php
                    $vertical_banner = App\Models\Banner::where('type',1)->where('status',1)->inRandomOrder()->first();
                @endphp
                <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                    <div class="banner-img style-2">
                        <img src="{{asset($vertical_banner->banner_img)}}" alt="" />
                        <div class="banner-text">
                            <h2 class="mb-100">
                                {!! $banner->title !!}
                            </h2>
                            <p>{!! $banner->description !!}</p>
                            @if ($banner->link != null)
                                <a href="{{$banner->link}}" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                    <div class="tab-content" id="myTabContent-1">
                        @if ($featureds->count() != 0)
                            <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                                <div class="carausel-4-columns-cover arrow-center position-relative">
                                    <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                                    <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                                        @forelse ($featureds as $product)
                                            <div class="product-cart-wrap">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
                                                            <img class="default-img" src="{{$product->product_thumbnail}}" alt="" />
                                                            <img class="hover-img" src="{{$product->product_thumbnail}}" alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="product-action-1 d-flex flex-row">
                                                        <a aria-label="Add To Wishlist" class="action-btn" id="{{$product->id}}" onclick="addToWishlist(this.id)"><i class="fi-rs-heart"></i></a>
                                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$product->id}}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                                    </div>
                                                    @if ($product->product_qty == 0)
                                                        <div class="product-badges product-badges-position product-badges-mrg">
                                                            <span class="hot">Out Of Stock</span>
                                                        </div>
                                                    @else
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
                                                    <div class="sold mt-15 mb-15">
                                                        <span class="font-xs text-heading">
                                                            @if ($product->product_qty == 0)
                                                                <span class="text-danger">Out Of Stock</span>
                                                            @else
                                                                Stock: {{$product->product_qty}} Left
                                                                @if ($product->product_qty <= 10)
                                                                    <span class="text-warning">Low stock</span>
                                                                @endif
                                                            @endif
                                                        </span>
                                                    </div>
                                                    @if ($product->product_qty > 0)
                                                        <a data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$product->id}}" onclick="productView(this.id)" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--End product Wrap-->
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!--End tab-pane-->
                        @if ($special_deals->count() != 0)
                            <div class="tab-pane fade" id="tab-two-1" role="tabpanel" aria-labelledby="tab-two-1">
                                <div class="carausel-4-columns-cover arrow-center position-relative">
                                    <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-2-arrows"></div>
                                    <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns-2">
                                        @forelse ($special_deals as $product)
                                            <div class="product-cart-wrap">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
                                                            <img class="default-img" src="{{$product->product_thumbnail}}" alt="" />
                                                            <img class="hover-img" src="{{$product->product_thumbnail}}" alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="product-action-1 d-flex flex-row">
                                                        <a aria-label="Add To Wishlist" class="action-btn" id="{{$product->id}}" onclick="addToWishlist(this.id)"><i class="fi-rs-heart"></i></a>
                                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$product->id}}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                                    </div>
                                                    @if ($product->product_qty == 0)
                                                        <div class="product-badges product-badges-position product-badges-mrg">
                                                            <span class="hot">Out Of Stock</span>
                                                        </div>
                                                    @else
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
                                                    <div class="sold mt-15 mb-15">
                                                        <span class="font-xs text-heading">
                                                            @if ($product->product_qty == 0)
                                                                <span class="text-danger">Out Of Stock</span>
                                                            @else
                                                                Stock: {{$product->product_qty}} Left
                                                                @if ($product->product_qty <= 10)
                                                                    <span class="text-warning">Low stock</span>
                                                                @endif
                                                            @endif
                                                        </span>
                                                    </div>
                                                    @if ($product->product_qty > 0)
                                                        <a data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$product->id}}" onclick="productView(this.id)" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--End product Wrap-->
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($special_offers->count() != 0)
                            <div class="tab-pane fade" id="tab-three-1" role="tabpanel" aria-labelledby="tab-three-1">
                                <div class="carausel-4-columns-cover arrow-center position-relative">
                                    <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-3-arrows"></div>
                                    <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns-3">
                                        @forelse ($special_offers as $product)
                                            <div class="product-cart-wrap">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
                                                            <img class="default-img" src="{{$product->product_thumbnail}}" alt="" />
                                                            <img class="hover-img" src="{{$product->product_thumbnail}}" alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="product-action-1 d-flex flex-row">
                                                        <a aria-label="Add To Wishlist" class="action-btn" id="{{$product->id}}" onclick="addToWishlist(this.id)"><i class="fi-rs-heart"></i></a>
                                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$product->id}}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                                    </div>
                                                    @if ($product->product_qty == 0)
                                                        <div class="product-badges product-badges-position product-badges-mrg">
                                                            <span class="hot">Out Of Stock</span>
                                                        </div>
                                                    @else
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
                                                    <div class="sold mt-15 mb-15">
                                                        <span class="font-xs text-heading">
                                                            @if ($product->product_qty == 0)
                                                                <span class="text-danger">Out Of Stock</span>
                                                            @else
                                                                Stock: {{$product->product_qty}} Left
                                                                @if ($product->product_qty <= 10)
                                                                    <span class="text-warning">Low stock</span>
                                                                @endif
                                                            @endif
                                                        </span>
                                                    </div>
                                                    @if ($product->product_qty > 0)
                                                        <a data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$product->id}}" onclick="productView(this.id)" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--End product Wrap-->
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!--End tab-content-->
                </div>
                <!--End Col-lg-9-->
            </div>
        </div>
    </section>
    <!--End Best Sales-->
    @if ($hot_deals->count() != 0)
        <section class="section-padding pb-5">
            <div class="container">
                <div class="section-title wow animate__animated animate__fadeIn" data-wow-delay="0">
                    <h3 class="">Deals Of The Day</h3>
                    <a class="show-all" href="/">
                        All Deals
                        <i class="fi-rs-angle-right"></i>
                    </a>
                </div>
                <div class="row">
                    @foreach ($hot_deals as $key=>$product)
                        <div class="col-xl-3 col-lg-4 col-md-6 @if($key >=2)d-none d-lg-block @endif">
                            <div class="product-cart-wrap style-2 wow animate__animated animate__fadeInUp" data-wow-delay=".{{$key++}}s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img">
                                        <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}" target="_blank">
                                            <img src="{{asset($product->product_thumbnail)}}" alt="" />
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="deals-countdown-wrap">
                                        <div class="deals-countdown" data-countdown="2023/10/16 00:00:00"></div>
                                    </div>
                                    <div class="deals-content">
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
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div>
                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">NestFood</a></span>
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
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!--End Deals-->
    @endif

    {{-- <section class="section-padding mb-30">
        <div class="container">
            <div class="row">
                @if ($skip_product_0->count() != 0)
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <h4 class="section-title style-1 mb-30 animated animated">{{$skip_category_0->name}}</h4>
                        <div class="product-list-small animated animated">
                            @forelse ($skip_product_0 as $product)
                                <article class="row align-items-center hover-up">
                                    <figure class="col-md-4 mb-0">
                                        <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
                                            <img src="{{$product->product_thumbnail}}" alt="" />
                                        </a>
                                    </figure>
                                    <div class="col-md-8 mb-0">
                                        <div class="product-brand">
                                            <a href="{{Route('product.brand.details',[$product->brand_id])}}?brand={{$product->brand->slug}}">
                                                {{$product->brand->name}}
                                            </a>
                                        </div>
                                        <h6>
                                            <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
                                                {!! Str::limit($product->product_name,25) !!}
                                            </a>
                                        </h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div class="product-price">
                                            @if ($product->discount_price)
                                                <span>${{$product->discount_price}} </span>
                                            @else
                                                <span>${{$product->selling_price}} </span>
                                            @endif
                                            <span class="old-price">${{$product->base_price}}</span>
                                        </div>
                                    </div>
                                </article>
                            @empty

                            @endforelse
                        </div>
                    </div>
                @endif
                @if ($skip_product_1->count() != 0)
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <h4 class="section-title style-1 mb-30 animated animated">{{$skip_category_1->name}}</h4>
                        <div class="product-list-small animated animated">
                            @forelse ($skip_product_1 as $product)
                                <article class="row align-items-center hover-up">
                                    <figure class="col-md-4 mb-0">
                                        <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
                                            <img src="{{$product->product_thumbnail}}" alt="" />
                                        </a>
                                    </figure>
                                    <div class="col-md-8 mb-0">
                                        <div class="product-brand">
                                            <a href="{{Route('product.brand.details',[$product->brand_id])}}?brand={{$product->brand->slug}}">
                                                {{$product->brand->name}}
                                            </a>
                                        </div>
                                        <h6>
                                            <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
                                                {!! Str::limit($product->product_name,25) !!}
                                            </a>
                                        </h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div class="product-price">
                                            @if ($product->discount_price)
                                                <span>${{$product->discount_price}} </span>
                                            @else
                                                <span>${{$product->selling_price}} </span>
                                            @endif
                                            <span class="old-price">${{$product->base_price}}</span>
                                        </div>
                                    </div>
                                </article>
                            @empty

                            @endforelse
                        </div>
                    </div>
                @endif
                @if ($skip_brand_product_0->count() != 0)
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <h4 class="section-title style-1 mb-30 animated animated">{{$skip_brand_0->name}}</h4>
                        <div class="product-list-small animated animated">
                            @forelse ($skip_brand_product_0 as $product)
                                <article class="row align-items-center hover-up">
                                    <figure class="col-md-4 mb-0">
                                        <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
                                            <img src="{{$product->product_thumbnail}}" alt="" />
                                        </a>
                                    </figure>
                                    <div class="col-md-8 mb-0">
                                        <div class="product-brand">
                                            <a href="{{Route('product.brand.details',[$product->brand_id])}}?brand={{$product->brand->slug}}">
                                                {{$product->brand->name}}
                                            </a>
                                        </div>
                                        <h6>
                                            <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
                                                {!! Str::limit($product->product_name,25) !!}
                                            </a>
                                        </h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div class="product-price">
                                            @if ($product->discount_price)
                                                <span>${{$product->discount_price}} </span>
                                            @else
                                                <span>${{$product->selling_price}} </span>
                                            @endif
                                            <span class="old-price">${{$product->base_price}}</span>
                                        </div>
                                    </div>
                                </article>
                            @empty

                            @endforelse
                        </div>
                    </div>
                @endif
                @if ($skip_brand_product_1->count() != 0)
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                        <h4 class="section-title style-1 mb-30 animated animated">{{$skip_brand_1->name}}</h4>
                        <div class="product-list-small animated animated">
                            @forelse ($skip_brand_product_1 as $product)
                                <article class="row align-items-center hover-up">
                                    <figure class="col-md-4 mb-0">
                                        <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
                                            <img src="{{$product->product_thumbnail}}" alt="" />
                                        </a>
                                    </figure>
                                    <div class="col-md-8 mb-0">
                                        <div class="product-brand">
                                            <a href="{{Route('product.brand.details',[$product->brand_id])}}?brand={{$product->brand->slug}}">
                                                {{$product->brand->name}}
                                            </a>
                                        </div>
                                        <h6>
                                            <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
                                                {!! Str::limit($product->product_name,25) !!}
                                            </a>
                                        </h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div class="product-price">
                                            @if ($product->discount_price)
                                                <span>${{$product->discount_price}} </span>
                                            @else
                                                <span>${{$product->selling_price}} </span>
                                            @endif
                                            <span class="old-price">${{$product->base_price}}</span>
                                        </div>
                                    </div>
                                </article>
                            @empty

                            @endforelse
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section> --}}
    <!--End 4 columns-->

    <section class="section-padding mb-30">
        <div class="container">
            <div class="row">
                @foreach ($category_max_product as $key=>$item)
                    <div class="col-xl-3 col-lg-4 col-md-6 @if ($key == 1) mb-sm-5 @endif mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay=".{{$key++}}s">
                        <h4 class="section-title style-1 mb-30 animated animated">{{$item->name}}</h4>
                        <div class="product-list-small animated animated">
                            @forelse ($item->product->take(4) as $product)
                                <article class="row align-items-center hover-up">
                                    <figure class="col-md-4 mb-0">
                                        <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
                                            <img src="{{$product->product_thumbnail}}" alt="" />
                                        </a>
                                    </figure>
                                    <div class="col-md-8 mb-0">
                                        <div class="product-brand">
                                            <a href="{{Route('product.brand.details',[$product->brand_id])}}?brand={{$product->brand->slug}}">
                                                {{$product->brand->name}}
                                            </a>
                                        </div>
                                        <h6>
                                            <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
                                                {!! Str::limit($product->product_name,25) !!}
                                            </a>
                                        </h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div class="product-price">
                                            @if ($product->discount_price)
                                                <span>${{$product->discount_price}} </span>
                                            @else
                                                <span>${{$product->selling_price}} </span>
                                            @endif
                                            <span class="old-price">${{$product->base_price}}</span>
                                        </div>
                                    </div>
                                </article>
                            @empty

                            @endforelse
                        </div>
                    </div>
                @endforeach
                @foreach ($brand_max_product as $key=>$item)
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp" data-wow-delay=".{{$key++}}s">
                        <h4 class="section-title style-1 mb-30 animated animated">{{$item->name}}</h4>
                        <div class="product-list-small animated animated">
                            @forelse ($item->product->take(4) as $product)
                                <article class="row align-items-center hover-up">
                                    <figure class="col-md-4 mb-0">
                                        <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
                                            <img src="{{$product->product_thumbnail}}" alt="" />
                                        </a>
                                    </figure>
                                    <div class="col-md-8 mb-0">
                                        <div class="product-brand">
                                            <a href="{{Route('product.brand.details',[$product->brand_id])}}?brand={{$product->brand->slug}}">
                                                {{$product->brand->name}}
                                            </a>
                                        </div>
                                        <h6>
                                            <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
                                                {!! Str::limit($product->product_name,25) !!}
                                            </a>
                                        </h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div class="product-price">
                                            @if ($product->discount_price)
                                                <span>${{$product->discount_price}} </span>
                                            @else
                                                <span>${{$product->selling_price}} </span>
                                            @endif
                                            <span class="old-price">${{$product->base_price}}</span>
                                        </div>
                                    </div>
                                </article>
                            @empty

                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--End 5 columns-->
</main>

