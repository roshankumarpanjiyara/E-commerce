@php
    use App\Models\WebsiteSetting;

    $website = WebsiteSetting::findOrFail(1);
@endphp
<section class="section-padding pb-5">
    <div class="section-title">
        <h3 class="">Deals Of The Day</h3>
        <a class="show-all" href="/">
            All Deals
            <i class="fi-rs-angle-right"></i>
        </a>
    </div>
    <div class="row">
        @foreach ($hot_deals as $key=>$product)
            <div class="col-xl-3 col-lg-4 col-md-6 @if($key++ >=2)d-none d-lg-block @endif">
                <div class="product-cart-wrap style-2">
                    <div class="product-img-action-wrap">
                        <div class="product-img">
                            <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
                                <img src="{{asset($product->product_thumbnail)}}" alt="" />
                            </a>
                        </div>
                    </div>
                    <div class="product-content-wrap">
                        <div class="deals-countdown-wrap">
                            <div class="deals-countdown" data-countdown="2023/10/21 00:00:00"></div>
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
            </div>
        @endforeach
    </div>
</section>
<!--End Deals-->
