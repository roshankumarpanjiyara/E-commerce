<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        @php
            use App\Models\SeoSetting;
            use App\Models\WebsiteSetting;

            $seo = SeoSetting::find(1);
            $website = WebsiteSetting::find(1);
        @endphp 
        <meta charset="utf-8" />
        <title>@yield('main_title')E-Commerce</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="{{$seo->meta_description}}" />
        <meta name="author" content="{{ $seo->meta_author }}">
        <meta name="keywords" content="{{ $seo->meta_keyword }}">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="{{$seo->meta_title}}" />
        <meta property="og:url" content="{{$seo->meta_url}}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset($website->icon)}}"/>

        {{-- google analytics --}}
        <script>
            {{ $seo->google_analytics }}
        </script>
        
        <!-- Template CSS -->
        <link rel="stylesheet" href="{{asset("frontend/assets/css/plugins/animate.min.css")}}"/>
        <link rel="stylesheet" href="{{asset("frontend/assets/css/main.css?v=4.0")}}"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

        <script src="https://js.stripe.com/v3/"></script>

        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
        <style>
            :root{
                /* --hue-color: #3BB77E; */
                /* --main-color: hsl(var(--hue-color), 10%, 10%); */
                /* --main-color: #3BB77E; */
                /* --hover-color: #FDC040; */
                --main-color: {{$website->main_color}};
                --hover-color: {{$website->hover_color}};
            }
        </style>
    </head>

    <body>

        <!-- Quick view -->
        <div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModal"></button>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                <div class="detail-gallery">
                                    <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">
                                        <figure class="border-radius-10">
                                            <img src="" alt="product image" id="pimage"/>
                                        </figure>

                                    </div>
                                    <!-- THUMBNAILS -->
                                    {{-- <div class="slider-nav-thumbnails">
                                        <div><img src="" alt="product image" id="timage"/></div>
                                        <div name="multiImages">

                                        </div>
                                    </div> --}}
                                </div>
                                <!-- End Gallery -->
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info pr-30 pl-30">
                                    <span class="stock-status out-stock" id="dis-stock"></span>
                                    <h4 class="title-detail text-muted"><span id="pbrand"></span></h4>
                                    <h3 class="title-detail" style="font-size:1.5rem"><span id="pname"></span></h3>
                                    <div class="product-detail-rating">
                                        <div class="product-rate-cover text-end">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                        </div>
                                    </div>
                                    <div class="clearfix product-price-cover">
                                            <div class="product-price primary-color float-left">
                                                <span class="current-price text-brand" style="font-size:1.5rem" name="price"></span>
                                                <span>
                                                    <span class="save-price font-md color3 ml-15" name="discount"></span>
                                                    <span class="old-price font-md ml-15" style="font-size:1.5rem">$<span id="base_price"></span></span>
                                                </span>
                                            </div>
                                    </div>
                                    <div class="attr-detail attr-size mb-30" id="size_area">
                                        <strong class="mr-15">Size: </strong>
                                        <select class="form-select select-active" data-placeholder="Select size *" data-control="select2" id="size" name="size">

                                        </select>
                                    </div>
                                    <div class="detail-extralink mb-30">
                                        <div class="detail-qty border radius">
                                            <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                            <span class="qty-val" id="qty">1</span>
                                            <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                        </div>
                                        <input type="hidden" id="product_id">
                                        <div class="product-extra-link2" id="button-add-cart">
                                            <button type="submit" class="button button-add-to-cart" onclick="addToCart()"><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>
                                    <div class="font-xs">
                                        <ul>
                                            <li class="mb-5">SKU: <span class="text-brand" id="sku"></span></li>
                                            <li class="mb-5">Stock:
                                                <span class="text-brand" id="available"></span>
                                                <span class="text-brand text-danger" id="outOfStock"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Detail Info -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <header class="header-area header-style-1 header-style-5 header-height-2">
            <div class="mobile-promotion py-0">
                <span>{!! $website->mobile_promotion !!}</span>
            </div>
            <div class="header-top header-top-ptb-1 d-none d-lg-block">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-4">
                            <div class="header-info">
                                <ul>
                                    <li><a href="{{route("about.us")}}">About Us</a></li>
                                    <li><a href="{{route("contact.us")}}">Contact Us</a></li>
                                    <li><a href="{{route("wishlist")}}">Wishlist</a></li>
                                    <li><a href="{{route("mycart")}}">My Cart</a></li>
                                    <li><a href="{{route("myorder")}}">Order</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-4">
                            <div class="text-center">
                                <div id="news-flash" class="d-inline-block">
                                    <ul>
                                        {!! $website->scroll_ads !!}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4">
                            <div class="header-info header-info-right">
                                <ul>
                                    <li>Need help? Call Us: <strong class="text-brand"> +91 {{$website->phone}}</strong></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
                <div class="container">
                    <div class="header-wrap">
                        <div class="logo logo-width-1">
                            <a href="/"><img src="{{asset($website->logo)}}" alt="logo" style="width: 250px"/></a>
                        </div>
                        <div class="header-right">
                            <div class="search-style-1">
                                <form action="" method="POST">@csrf
                                    <input type="text" placeholder="Search for items..." name="search" autocomplete="off" required class="view" onfocus="search_result_show()" onblur="search_result_hide()" id="productsearch">
                                </form>
                                <div class="answersearch" id="allProductSearch"></div>
                                    <script type="text/javascript">
                                        $("body").on("keyup", "#productsearch", function(){
                                            let text = $("#productsearch").val();
                                            // console.log(text);
                                            if (text.length > 0) {
                                                $.ajax({
                                                    data: {search: text},
                                                    url : "product-search",
                                                    method : 'post',
                                                    // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                                    success:function(result){
                                                        $("#allProductSearch").html(result);
                                                    }
                                                }); // end ajax
                                                $(document).on('click','p',function(){
                                                    $("#productsearch").val($(this).text());
                                                    $("#allProductSearch").html('');
                                                    $("#productsearch").val("");
                                                });
                                            } // end if
                                            if (text.length < 1 ) $("#allProductSearch").html("");
                                        });

                                        function search_result_hide(){
                                            $("#allProductSearch").slideUp();
                                        }

                                        function search_result_show(){
                                            $("#allProductSearch").slideDown();
                                        }
                                    </script>
                            </div>
                            <div class="header-action-right">
                                <div class="header-action-2">
                                    <div class="header-action-icon-2">
                                        <a href="shop-wishlist.html">
                                            <img class="svgInject" alt="Nest" src="{{asset("frontend/assets/imgs/theme/icons/icon-heart.svg")}}" />
                                        </a>
                                        <a href="{{route("wishlist")}}"><span class="lable">Wishlist</span></a>
                                    </div>
                                    <div class="header-action-icon-2">
                                        <a class="mini-cart-icon" href="">
                                            <img alt="Nest" src="{{asset("frontend/assets/imgs/theme/icons/icon-cart.svg")}}" />
                                            <span class="pro-count blue" id="cartQty">0</span>
                                        </a>
                                        <a href="{{route('mycart')}}"><span class="lable">Cart</span></a>
                                        <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                            <ul>
                                                <div id="miniCart"></div>
                                            </ul>
                                            <div class="shopping-cart-footer">
                                                <div class="shopping-cart-total">
                                                    <h4>Total <span id="cartsubTotal"></span></h4>
                                                </div>
                                                <div class="shopping-cart-button">
                                                    <a href="{{route('mycart')}}" class="outline">View cart</a>
                                                    <a href="{{route('checkout')}}">Checkout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if (Auth::check())
                                        <div class="header-action-icon-2">
                                            <a href="{{route("dashboard")}}">
                                                <img class="svgInject" alt="Nest" src="{{asset("frontend/assets/imgs/theme/icons/icon-user.svg")}}" />
                                            </a>
                                            <a href="{{route("dashboard")}}"><span class="lable ml-0">{{Auth::user()->name}}</span></a>
                                            <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                                <ul>
                                                    <li>
                                                        <a href="{{route("dashboard")}}"><i class="fi fi-rs-user mr-10"></i>My Account</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route("myorder")}}"><i class="fi fi-rs-location-alt mr-10"></i>My Orders</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route("return.order.list")}}"><i class="fi fi-rs-location-alt mr-10"></i>Return Orders</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route("cancel.order.list")}}"><i class="fi fi-rs-location-alt mr-10"></i>Cancel Orders</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route("wishlist")}}"><i class="fi fi-rs-heart mr-10"></i>My Wishlist</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route('user.profile.edit',[Auth::user()->id,Auth::user()->name])}}"><i class="fi fi-rs-settings-sliders mr-10"></i>Setting</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();"><i class="fi fi-rs-sign-out mr-10"></i>Sign out</a>
                                                    </li>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                </ul>
                                            </div>
                                        </div>
                                    @else
                                        <div class="header-action-icon-2">
                                            <a href="{{route("login")}}">
                                                <img class="svgInject" alt="Nest" src="{{asset("frontend/assets/imgs/theme/icons/icon-user.svg")}}" />
                                            </a>
                                            <a href="{{route("login")}}"><span class="lable ml-0">Account</span></a>
                                            <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                                <ul>
                                                    <li>
                                                        <a href="{{route("login")}}"><i class="fi fi-rs-user mr-10"></i>Login</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route("register")}}"><i class="fi fi-rs-location-alt mr-10"></i>Register</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom header-bottom-bg-color sticky-bar">
                <div class="container">
                    <div class="header-wrap header-space-between position-relative">
                        <div class="logo logo-width-1 d-block d-lg-none">
                            <a href="/"><img src="{{asset($website->logo)}}" alt="logo" /></a>
                        </div>
                        <div class="header-nav d-none d-lg-flex pl-5">
                            <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                                <nav>
                                    <ul>
                                        <li>
                                            <a href="/">Home</a>
                                        </li>
                                        @php
                                                $categories = App\Models\Category::orderBy('created_at','ASC')->get();
                                        @endphp
                                        @foreach ($categories as $category)
                                            <li class="position-static">
                                                <a>{{$category->name}} <i class="fi-rs-angle-down"></i></a>
                                                <ul class="mega-menu">
                                                    @php
                                                         $subcategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('created_at','ASC')->get();
                                                    @endphp
                                                    @foreach ($subcategories as $subcategory)
                                                        <li class="sub-mega-menu sub-mega-menu-width-22 mb-4">
                                                            <a class="menu-title" href="{{Route('product.subcategory.details',[$subcategory->id])}}?category={{$subcategory->category->slug}}&subcategory={{$subcategory->slug}}">{{$subcategory->name}}</a>
                                                            <ul>
                                                                @php
                                                                    $subsubcategories = App\Models\SubSubCategory::where('subcategory_id',$subcategory->id)->orderBy('created_at','ASC')->get();
                                                                @endphp
                                                                @foreach ($subsubcategories as $subsubcategory)
                                                                    <li><a href="{{Route('product.subsubcategory.details',[$subsubcategory->id])}}?category={{$subsubcategory->category->slug}}&subcategory={{$subsubcategory->subcategory->slug}}&subsubcategory={{$subsubcategory->slug}}">{{$subsubcategory->name}}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                        <li>
                                            <a href="{{route("blog.index")}}">Blog</a>
                                        </li>
                                        <li>
                                            <a href="{{route("contact.us")}}">Contact</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="hotline d-none d-lg-flex">
                            <img src="{{asset("frontend/assets/imgs/theme/icons/icon-headphone.svg")}}" alt="hotline" />
                            <p>+91 {{$website->phone}}<span>24/7 Support Center</span></p>
                        </div>
                        <div class="header-action-icon-2 d-block d-lg-none">
                            <div class="burger-icon burger-icon-white">
                                <span class="burger-icon-top"></span>
                                <span class="burger-icon-mid"></span>
                                <span class="burger-icon-bottom"></span>
                            </div>
                        </div>
                        <div class="header-action-right d-block d-lg-none">
                            <div class="header-action-2">
                                <div class="header-action-icon-2">
                                    <a href="{{route("wishlist")}}">
                                        <img alt="Nest" src="{{asset("frontend/assets/imgs/theme/icons/icon-heart.svg")}}" />
                                    </a>
                                </div>
                                <div class="header-action-icon-2">
                                    <a class="mini-cart-icon" href="{{route('mycart')}}">
                                        <img alt="Nest" src="{{asset("frontend/assets/imgs/theme/icons/icon-cart.svg")}}" />
                                        <span class="pro-count white" id="cartQty-mobile">0</span>
                                    </a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                        <ul>
                                            <div id="miniCart-mobile"></div>
                                        </ul>
                                        <div class="shopping-cart-footer">
                                            <div class="shopping-cart-total">
                                                <h4>Total <span id="cartsubTotal"></span></h4>
                                            </div>
                                            <div class="shopping-cart-button">
                                                <a href="{{route('mycart')}}">View cart</a>
                                                <a href="shop-checkout.html">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="mobile-header-active mobile-header-wrapper-style">
            <div class="mobile-header-wrapper-inner">
                <div class="mobile-header-top">
                    <div class="mobile-header-logo">
                        <a href="/"><img src="{{asset($website->logo)}}" alt="logo" style="width: 11.25rem"/></a>
                    </div>
                    <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                        <button class="close-style search-close">
                            <i class="icon-top"></i>
                            <i class="icon-bottom"></i>
                        </button>
                    </div>
                </div>
                <div class="mobile-header-content-area">
                    <div class="mobile-search search-style-3 mobile-header-border">
                        <form action="#">
                            <input type="text" placeholder="Search for items…" />
                            <button type="submit"><i class="fi-rs-search"></i></button>
                        </form>
                    </div>
                    <div class="mobile-menu-wrap mobile-header-border">
                        <!-- mobile menu start -->
                        <nav>
                            <ul class="mobile-menu font-heading">
                                <li class="menu-item-has-children">
                                    <a href="/">Home</a>
                                </li>
                                @foreach ($categories as $category)
                                    <li class="menu-item-has-children">
                                        <a>{{$category->name}}</a>
                                        <ul class="dropdown">
                                            @php
                                                    $subcategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('created_at','ASC')->get();
                                            @endphp
                                            @foreach ($subcategories as $subcategory)
                                                <li class="menu-item-has-children">
                                                    <a href="{{Route('product.subcategory.details',[$subcategory->id])}}?category={{$subcategory->category->slug}}&subcategory={{$subcategory->slug}}">{{$subcategory->name}}</a>
                                                    <ul class="dropdown">
                                                        @php
                                                            $subsubcategories = App\Models\SubSubCategory::where('subcategory_id',$subcategory->id)->orderBy('created_at','ASC')->get();
                                                        @endphp
                                                        @foreach ($subsubcategories as $subsubcategory)
                                                            <li><a href="{{Route('product.subsubcategory.details',[$subsubcategory->id])}}?category={{$subsubcategory->category->slug}}&subcategory={{$subsubcategory->subcategory->slug}}&subsubcategory={{$subsubcategory->slug}}">{{$subsubcategory->name}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                                <li class="menu-item-has-children">
                                    <a href="{{route('blog.index')}}">Blog</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="{{route('contact.us')}}">Contact</a>
                                </li>
                            </ul>
                        </nav>
                        <!-- mobile menu end -->
                    </div>
                    <div class="mobile-header-info-wrap">
                        <div class="single-mobile-header-info">
                            <a href="{{route('contact.us')}}"><i class="fi-rs-marker"></i> Our location </a>
                        </div>
                        <div class="single-mobile-header-info">
                            @if (Auth::check())
                                <a href="{{route("dashboard")}}"><i class="fi-rs-user"></i>{{Auth::user()->name}} </a>
                            @else
                                <a href="{{route("login")}}"><i class="fi-rs-user"></i>Log In / Sign Up </a>
                            @endif
                        </div>
                        <div class="single-mobile-header-info">
                            <a href="#"><i class="fi-rs-headphones"></i>(+91) {{$website->phone}}</a>
                        </div>
                    </div>
                    <div class="mobile-social-icon mb-50">
                        <h6 class="mb-15">Follow Us</h6>
                        @if ($website->facebook != NULL)
                            <a href="{{$website->facebook}}"><img src="{{("frontend/assets/imgs/theme/icons/icon-facebook-white.svg")}}" alt="facebook" /></a>
                        @endif
                        @if ($website->instagram != NULL)
                            <a href="{{$website->instagram}}"><img src="{{("frontend/assets/imgs/theme/icons/icon-instagram-white.svg")}}" alt="instagram" /></a>
                        @endif
                        @if ($website->twitter != NULL)
                            <a href="{{$website->twitter}}"><img src="{{("frontend/assets/imgs/theme/icons/icon-twitter-white.svg")}}" alt="twitter" /></a>
                        @endif
                        @if ($website->youtube != NULL)
                            <a href="{{$website->youtube}}"><img src="{{("frontend/assets/imgs/theme/icons/icon-youtube-white.svg")}}" alt="youtube" /></a>
                        @endif
                        {{-- @if ($website->linkedin != NULL)
                            <a href="{{$website->linkedin}}"><img src="{{("frontend/assets/imgs/theme/icons/icon-linkedin-white.svg")}}" alt="linkedin" /></a>
                        @endif --}}
                    </div>
                    <div class="site-copyright">Copyright 2021 © Roshan. All rights reserved. Powered by Roshan Kumar.</div>
                </div>
            </div>
        </div>
        <!--End header-->
        <style>
            #product-title-h2{
                font-size: 0.875rem;
            }
            .product-cart-wrap .product-content-wrap .product-brand {
                margin-bottom: 1px;
            }

            .product-cart-wrap .product-content-wrap .product-brand a {
                color: #353535;
                font-size: 1rem;
                font-weight: bold;
            }

            .product-cart-wrap .product-content-wrap .product-brand a:hover {
                color: #3BB77E;
            }

            .product-cart-wrap .product-card-bottom .out-of-stock {
                cursor: pointer;
            }

            .product-cart-wrap .product-card-bottom .out-of-stock .add {
                position: relative;
                display: inline-block;
                padding: 6px 12px 6px 12px;
                border-radius: 4px;
                background-color: #f9dede;
                font-size: 12px;
                font-weight: 700;
            }

            .product-cart-wrap .product-card-bottom .out-of-stock .add:hover {
                background-color: #e96969;
                color: #fff;
                -webkit-transform: translateY(-3px);
                        transform: translateY(-3px);
                -webkit-box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.05);
                        box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.05);
            }

            .button-out-of-stock-modal {
                position: relative;
                padding: 0px 20px;
                border-radius: 5px;
                background-color: #f7bfbf;
                border: 0;
                height: 50px;
                line-height: 50px;
                font-weight: 700;
                font-size: 16px;
                font-family: "Quicksand", sans-serif;
            }

            .button-out-of-stock-modal:hover{
                background-color: #e96969;
                color: #fff;
                -webkit-transform: translateY(-3px);
                        transform: translateY(-3px);
                -webkit-box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.05);
                        box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.05);
            }

            .button-out-of-stock-modal i {
                margin-right: 10px;
            }
        </style>
        <style>
            .answersearch{
                position: absolute;
                background-color: #fff;
                min-width: 700px;
                /* max-width: 84%; */
                max-height: 450px;
                overflow-y: auto;
                /*overflow-y: scroll;*/
                margin: 0px 0 0 0px;
                z-index: 3;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                -webkit-transition: all 0.3s ease-in-out;
                -moz-transition: all 0.3s ease-in-out;
                -o-transition: all 0.3s ease-in-out;
                -ms-transition: all 0.3s ease-in-out;
                transition: all 0.3s ease-in-out;
                /*display: none;*/
                /*min-height: 100px;*/
                /* padding: 10px 2px; */
            }

            .answersearch p{
                cursor: pointer;
                padding: 5px 15px 5px 15px;
                margin: 0;
                border-bottom: 1px solid #fff;
            }

            .answersearch p:last-child{border: none;}

            .answersearch p:hover{
                color: #583101;
                background-color: #ffecd5;
                border-left: 3px solid #fc8902;
            }
        </style>
