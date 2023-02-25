{{-- product detail --}}
<a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
    {!! Str::limit($product->product_name,20) !!}
</a>
{{-- subcategory details --}}
href="{{Route('product.subcategory.details',[$subcategory->id])}}?category={{$subcategory->category->slug}}&subcategory={{$subcategory->slug}}"
{{-- subsub --}}
href="{{Route('product.subsubcategory.details',[$subsubcategory->id])}}?category={{$subsubcategory->category->slug}}&subcategory={{$subsubcategory->subcategory->slug}}%subsubcatgeory={{$subsubcategory->slug}}"



{{-- brand name--}}
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


{{-- price --}}
@if ($product->discount_price)
    <span>${{$product->discount_price}} </span>
@else
    <span>${{$product->selling_price}} </span>
@endif
<span class="old-price">${{$product->base_price}}</span>


<div class="add-cart">
    <a class="add" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$product->id}}" onclick="productView(this.id)"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
</div>

@if ($product->product_qty > 0)
    <a data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$product->id}}" onclick="productView(this.id)" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
@endif

{{-- action --}}
<div class="product-action-1 d-flex flex-row">
    <a aria-label="Add To Wishlist" class="action-btn" id="{{$product->id}}" onclick="addToWishlist(this.id)"><i class="fi-rs-heart"></i></a>
    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$product->id}}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
</div>

{{-- wishlist --}}
href="{{route("wishlist")}}"
